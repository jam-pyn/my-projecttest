<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Dishes;
use App\Models\User;
use App\Repositories\DishRepositoryInterface;
use App\Repositories\Eloquent\DishRepository;
use App\Repositories\MasterRepositoryInterface;
use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DishController extends Controller
{
    private $dishesRepository;
    public function __construct(DishRepository $dishRepository)
    {
        $this->dishesRepository = $dishRepository;
    }

    public function show($id)
    {
        $dish = Dishes::find($id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }

        return response()->json($dish);
    }
    public function dishById(Request $request)
    {
        $id = $request->id;

        // ค้นหาข้อมูล dish ตาม id พร้อมโหลดข้อมูล category ด้วย
        $dish = $this->dishesRepository->find($id, ['category']);

        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if ($dish) {
            return response()->json($dish);
        }

        return response()->json([
            'message' => 'ไม่พบข้อมูลเมนู',
            'code' => 404,
        ], 404);
    }

    // ฟังก์ชันดึงข้อมูลทั้งหมดในรูปแบบ DataTable
    public function dishWithDatatable(Request $request)
    {

        $postData = $request->all();

        // รับค่าจาก postData สำหรับ DataTable
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // จำนวนแถวที่จะแสดงในแต่ละหน้า

        $columnIndex = isset($postData['order'][0]['column']) ? $postData['order'][0]['column'] : 0;
        $columnName = isset($postData['columns'][$columnIndex]['data']) ? $postData['columns'][$columnIndex]['data'] : '';
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';
        $searchValue = $postData['search']['value']; // ค่าที่ใช้ในการค้นหา

        $param = [
            "columnName" => $columnName,
            "columnSortOrder" => $columnSortOrder,
            "searchValue" => $searchValue,
            "start" => $start,
            "rowperpage" => $rowperpage,
        ];

        // ฟิลด์ที่ใช้ในการค้นหา
        $searchField = ['dish_name', 'price'];

        // ความสัมพันธ์ที่ต้องการดึงข้อมูล
        $relationsship = ['category'];

        // คำนวณจำนวนรวมทั้งหมด
        $totalRecordswithFilter = $totalRecords = $this->dishesRepository->getAll($param, $searchField, $relationsship)->count();

        // ดึงข้อมูลเมนูทั้งหมดพร้อมกับการค้นหา
        $records = $this->dishesRepository->paginate($param, $searchField, $relationsship);

        return [
            "aaData" => $records,
            "draw" => $draw,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
        ];
    }

    public function updateDishApi(Request $request)
    {
        $validated = $request->validate([
            'dish_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'dishId' => 'required|exists:dishes,id', // ตรวจสอบว่า dishId ที่ส่งมามีอยู่ในฐานข้อมูล
        ]);
        // ใน Controller ของ Laravel



        $dish = Dishes::find($request->dishId);
        $dish->dish_name = $request->dish_name;
        $dish->price = $request->price;

        if ($dish->save()) {
            return response()->json([
                'code' => 200,
                'message' => 'ข้อมูลของ ' . $dish->dish_name . ' ได้รับการอัพเดทแล้ว!',
            ]);
        }

        return response()->json([
            'code' => 500,
            'message' => 'เกิดข้อผิดพลาดในการอัพเดทข้อมูล',
        ]);
    }

    public function delete(Request $request, $id)
    {

        $data = $request->all();
        $dishId = $data['id'];


        if (!$dishId) {
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        }
        try {
            //อัปเดตข้อมูล
            $user = $this->dishesRepository->find($dishId);
            $user->delete();

            return response()->json([
                'message' => 'ลบข้อมูลสำเร็จ',
                'code' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,

            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'ลบข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),

            ], 500);
        }
    }
}
