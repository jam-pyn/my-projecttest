<?php

// กำหนด namespace สำหรับ controller นี้
namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Category; // ใช้สำหรับเรียกดูข้อมูลหมวดหมู่อาหาร
use App\Models\Dishes; // ใช้สำหรับเรียกดูข้อมูลอาหาร
use App\Models\User;
use App\Repositories\DishRepositoryInterface; // อินเตอร์เฟซของ repository สำหรับเมนูอาหาร
use App\Repositories\Eloquent\DishRepository; // ใช้งาน repository ที่ implement แบบ Eloquent
use App\Repositories\MasterRepositoryInterface;
use Illuminate\Http\Request; // ใช้รับข้อมูลจาก HTTP Request

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DishController extends Controller
{
    // ตัวแปรเก็บ repository สำหรับจัดการข้อมูลอาหาร
    private $dishesRepository;

    // ฟังก์ชัน construct จะทำงานตอนสร้าง object ของคลาสนี้ และรับ DishRepository เข้ามาใช้งาน
    public function __construct(DishRepository $dishRepository)
    {
        $this->dishesRepository = $dishRepository; // เก็บ repository ไว้ในตัวแปรสำหรับใช้ในเมธอดอื่น
    }

    // ฟังก์ชันสำหรับดึงข้อมูลอาหารตาม ID ที่ส่งมา
    public function dishById(Request $request)
    {
        $id = $request->id; // รับค่า id จาก request

        // ค้นหาข้อมูลอาหารตาม id พร้อมดึงข้อมูลหมวดหมู่ที่เกี่ยวข้องมาด้วย find ใช้กับ repository
        $dish = $this->dishesRepository->find($id, ['category']);

        // ถ้าพบข้อมูล ส่งกลับในรูปแบบ JSON
        if ($dish) {
            return response()->json($dish);
        }

        // ถ้าไม่พบ ส่งข้อความว่าไม่พบข้อมูล พร้อมรหัส 404
        return response()->json([
            'message' => 'ไม่พบข้อมูลเมนู ',
            'code' => 404,
        ], 404);
    }

    // ฟังก์ชันสำหรับดึงข้อมูลอาหารทั้งหมดเพื่อนำไปแสดงใน DataTable
    public function dishWithDatatable(Request $request)
    {
        $postData = $request->all(); // รับค่าทั้งหมดจาก request

        // ค่าที่ใช้จัดการแสดงผลของ DataTable
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // จำนวนแถวที่ต้องการแสดงต่อหน้า

        // ตรวจสอบว่ามีการระบุ column ที่ใช้จัดเรียงหรือไม่
        $columnIndex = isset($postData['order'][0]['column']) ? $postData['order'][0]['column'] : 0;
        $columnName = isset($postData['columns'][$columnIndex]['data']) ? $postData['columns'][$columnIndex]['data'] : '';
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';
        $searchValue = $postData['search']['value']; // ข้อความที่ใช้ในการค้นหา

        // รวมข้อมูลที่ใช้สำหรับจัดการการแสดงผล
        $param = [
            "columnName" => $columnName,
            "columnSortOrder" => $columnSortOrder,
            "searchValue" => $searchValue,
            "start" => $start,
            "rowperpage" => $rowperpage,
        ];

        // กำหนดฟิลด์ที่อนุญาตให้ใช้ค้นหาได้
        $searchField = ['dish_name', 'price'];

        // ระบุว่าให้ดึงข้อมูลความสัมพันธ์กับ category มาด้วย
        $relationsship = ['category'];

        // คำนวณจำนวนรายการทั้งหมด (ทั้งกรองและไม่กรอง)
        $totalRecordswithFilter = $totalRecords = $this->dishesRepository->getAll($param, $searchField, $relationsship)->count();

        // ดึงข้อมูลจริง ๆ โดยใช้การแบ่งหน้า
        $records = $this->dishesRepository->paginate($param, $searchField, $relationsship);

        // ส่งค่ากลับในรูปแบบที่ DataTable ต้องการ
        return [
            "aaData" => $records, // รายการข้อมูล
            "draw" => $draw, // ใช้ sync กับ frontend
            "iTotalRecords" => $totalRecords, // จำนวนรายการทั้งหมด
            "iTotalDisplayRecords" => $totalRecordswithFilter, // จำนวนรายการหลังกรอง
        ];
    }

    // ฟังก์ชันสำหรับอัปเดตข้อมูลเมนูอาหาร
    public function updateDishApi(Request $request)
    {
        $data = $request->all(); // รับค่าทั้งหมดจาก request
        $dishId = $data['dishId']; // ดึง ID ของอาหารที่จะอัปเดต
        $updateData = $data['updateData']; // ดึงข้อมูล key ที่ต้องการอัปเดตจากหน้าบ้าน

        try {
            // เรียกใช้ repository เพื่ออัปเดตข้อมูลเมนู
            $data_update = $this->dishesRepository->update($dishId, $updateData);

            // ส่งกลับว่าทำการอัปเดตสำเร็จ
            return response()->json([
                'message' => 'อัพเดทข้อมูลสำเร็จ',
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            // ถ้ามีข้อผิดพลาดเกิดขึ้น ส่งกลับข้อความผิดพลาด
            return response()->json([
                'message' => 'อัปเดตข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }

        // ส่งข้อมูลที่อัปเดตกลับไป (บรรทัดนี้จะไม่ถูกเรียกเพราะ return ไปแล้วด้านบน)
        return response()->json($data_update);
    }

    // ฟังก์ชันสำหรับลบข้อมูลเมนู
    public function deleteApi(Request $request)
    {
        $data = $request->all(); // รับข้อมูลทั้งหมดจาก request
        $deleteId = $data['deleteId']; // ดึงรหัสของเมนูที่ต้องการลบ ที่ส่งผ่านหน้าบ้าน

        // ถ้าไม่มีการส่ง deleteId มา ให้ส่งข้อความว่าไม่พบ
        if (!$deleteId) {
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        }

        try {
            // ดึงข้อมูลเมนูจากฐานข้อมูลด้วย ID
            $user = $this->dishesRepository->find($deleteId);
            $user->delete(); // ลบเมนูออกจากฐานข้อมูล

            // ส่งข้อความว่าลบสำเร็จ
            return response()->json([
                'message' => 'ลบข้อมูลสำเร็จ',
                'code' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            // ถ้าค้นหาไม่พบ ส่งข้อความว่าไม่พบ
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        } catch (\Exception $e) {
            // ถ้ามีข้อผิดพลาดอื่น ๆ เกิดขึ้น
            return response()->json([
                'message' => 'ลบข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
