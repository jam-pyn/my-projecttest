<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private $user;  //ประกาศตัวแปร $user

    //รับพารามิเตอร์ $userRepositoryInterface เพื่อกำหนดให้ตัวแปร $user สามารถใช้งานในคลาสนี้ได้
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->user = $userRepositoryInterface;  //กำหนดให้ตัวแปร $user เก็บค่า $userRepositoryInterface เพื่อใช้ในคลาสนี้
    }

    public function userById(Request $request)
    {
        // รับค่า id ที่ส่งมาจาก request
        $id = $request->id;

        // ค้นหาผู้ใช้โดยใช้ id ที่รับมาจากฐานข้อมูล
        $user = $this->user->find($id, ['role']);

        // โดยใช้ Eloquent eager loading ดึงข้อมูล role มาด้วย
        // $user = User::with('role')->find($id);

        // ส่งข้อมูลผู้ใช้กลับเป็น JSON response
        return response()->json($user);
    }

    public function userWithDatatable(Request $request)
    {
        $postData = $request->all();   //รับข้อมูลทั้งหมดจากคำขอ (request)
        ## Read value
        $draw = $postData['draw'];  
        $start = $postData['start'];  
        $rowperpage = $postData['length']; 

        $columnIndex = isset($postData['order'][0]['column']) ? $postData['order'][0]['column'] : 0;
        $columnName = isset($postData['columns'][$columnIndex]['data']) ? $postData['columns'][$columnIndex]['data'] : '';
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';
        $searchValue = $postData['search']['value']; // Search value
       
        //สร้างอาร์เรย์ที่ใช้เก็บค่าพารามิเตอร์สำหรับการค้นหาข้อมูล
        $param = [
            "columnName" => $columnName,
            "columnSortOrder" => $columnSortOrder,
            "searchValue" => $searchValue,
            "start" => $start,
            "rowperpage" => $rowperpage,
        ];

        $sherchField = [  //กำหนดฟิลด์ที่ใช้ในการค้นหา 
            'name',
            'email'
        ];
        $relationsship = [  //กำหนดความสัมพันธ์ของข้อมูล 
            'role'
        ];
        // Total records จำนวนข้อมูลทั้งหมดหลังจากการค้นหา
        $totalRecordswithFilter = $totalRecords = $this->user->getAll($param, $sherchField, $relationsship)->count();

        // Fetch records ดึงข้อมูลจากฐานข้อมูลที่ตรงตามเงื่อนไขการค้นหาและจัดเรียง
        $records = $this->user->paginate($param, $sherchField, $relationsship);

        return [        
            //ส่งค่าผลลัพธ์ในรูปแบบที่ DataTables ต้องการ เช่น ข้อมูลแถว, จำนวนแถวทั้งหมด, จำนวนแถวที่กรอง
            "aaData" => $records,
            "draw" => $draw,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
        ];
    }

    public function updateApi(Request $request)
    {

        // 1.รับข้อมูลจาก request เก็บไว้ในตัวแปร `$data`
        $data = $request->all();
        // dd($request->all());
        // dd($data);

        // 2.กำหนดค่าที่จะอัปเดตในตัวแปร `$updat`
        $updat = [
            'name' => $data['name'],
            'email' => $data['email'],
            'roles_id' => $data['roles_id'],
        ];

        try {
            // 3.เรียกใช้ฟังก์ชัน `update` ของ Model `User` เพื่ออัปเดตข้อมูล โดยใช้ userId , ข้อมูลในตัวแปร $updat ที่ถูกส่งมา  
            $data_update = $this->user->update($data['userId'], $updat);

            return response()->json([
                'message' => 'อัพเดทข้อมูลสำเร็จ',
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'อัปเดตข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }
        // 4.ส่งค่าที่อัปเดตแล้วกลับไปยังผู้ใช้งาน
        return response()->json($data_update);
    }


    public function delete(Request $request)
    {
        //ดึงข้อมูลทั้งหมดจาก request มาเก็บในตัวแปร $data
        $data = $request->all();

        //ดึงค่า userId จาก $data มาเก็บในตัวแปร $userId
        $userId = $data['userId'];


        if (!$userId) {
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        }
        try {
            //อัปเดตข้อมูล
            $user = $this->user->find($userId);
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
