<?php

namespace App\Repositories\Eloquent;

use App\Models\Base;
use App\Models\Dishes; 
use App\Repositories\MasterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

// คลาส MasterRepository สืบทอดจาก BaseRepository และต้องทำตามเงื่อนไขที่กำหนดใน MasterRepositoryInterface
class MasterRepository extends BaseRepository implements MasterRepositoryInterface
{
    // ตัวแปรไว้เก็บ model ที่จะถูกใช้งาน เช่น Dishes, Users ฯลฯ
    protected $model;

    // รับ model เข้ามาผ่าน constructor แล้วเก็บไว้ใน $model
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // เมธอดสำหรับสร้าง query ค้นหาข้อมูลโดยใช้ค่า searchValue
    private function buildSearchQuery($query, $param, $searchFields)
    {
        // ถ้ามีการส่งค่าคำค้นหามา
        if (isset($param['searchValue'])) {

            // วนลูปทุก field ที่กำหนดให้ค้นหา เช่น name, email ฯลฯ
            foreach ($searchFields as $field) {
                // เพิ่มเงื่อนไข orWhere ให้ค้นหาคำที่ใกล้เคียง (LIKE %value%)
                $query->orWhere($field, "like", '%' . $param['searchValue'] . '%');
            }
        }

        return $query;
    }

    /**
     * ดึงข้อมูลแบบแบ่งหน้า (pagination)
     * @param array $param พารามิเตอร์ที่ใช้ในการจัดเรียง ค้นหา และแบ่งหน้า
     * @param array|null $searchFields รายชื่อฟิลด์ที่สามารถค้นหาได้
     * @param array|null $withRelations รายชื่อความสัมพันธ์ที่ต้องการโหลดมาด้วย (เช่น category, user)
     * @return Collection ผลลัพธ์เป็น Collection ของข้อมูล
     */
    public function paginate($param, ?array $searchFields = null, ?array $withRelations = null): Collection
    {
        // ดึงค่าพารามิเตอร์ต่าง ๆ พร้อมตั้งค่าหากไม่มีส่งมา
        $columnName = data_get($param, 'columnName', 'id');      // คอลัมน์ที่ใช้ในการจัดเรียง
        $columnSortOrder = data_get($param, 'columnSortOrder', 'asc'); // ลำดับการจัดเรียง (asc / desc)
        $start = data_get($param, 'start', 0);                   // จุดเริ่มต้นของข้อมูล
        $rowperpage = data_get($param, 'rowperpage', 10);        // จำนวนแถวต่อหน้า

        // เริ่มสร้าง query โดยจัดเรียงตามคอลัมน์และลำดับที่กำหนด
        $query = $this->model->orderBy($columnName, $columnSortOrder);

        // เพิ่มเงื่อนไขการค้นหา ถ้ามีการระบุ searchFields
        $query = $this->buildSearchQuery($query, $param, $searchFields);

        // ถ้ามีความสัมพันธ์ (relations) ให้โหลดมาด้วย เช่น $with = ['category']
        if ($withRelations !== null && is_array($withRelations)) {
            $query->with($withRelations);
        }

        // ใช้ skip และ take เพื่อแบ่งหน้า แล้ว get() เพื่อดึงข้อมูล
        return $query->skip($start)
                     ->take($rowperpage)
                     ->get();
    }

    /**
     * ดึงข้อมูลทั้งหมดโดยไม่มีการแบ่งหน้า
     * @param array $param พารามิเตอร์การค้นหาและการจัดเรียง
     * @param array|null $searchFields รายชื่อฟิลด์ที่สามารถค้นหาได้
     * @param array|null $withRelations รายชื่อความสัมพันธ์ที่ต้องการโหลดมาด้วย
     * @return Collection ข้อมูลทั้งหมดที่ตรงกับเงื่อนไข
     */
    public function getAll($param, ?array $searchFields = null, ?array $withRelations = null): Collection
    {
        // ดึงค่าพารามิเตอร์จัดเรียง ถ้าไม่ส่งมาให้ใช้ค่าเริ่มต้น
        $columnName = data_get($param, 'columnName', 'id');
        $columnSortOrder = data_get($param, 'columnSortOrder', 'asc');

        // เริ่ม query ด้วยการจัดเรียง
        $query = $this->model->orderBy($columnName, $columnSortOrder);

        // เพิ่มเงื่อนไขการค้นหา ถ้ามี searchFields
        $query = $this->buildSearchQuery($query, $param, $searchFields);

        // ถ้ามี relations ที่ต้องโหลดมาด้วย ก็เพิ่มเข้าไปใน query
        if ($withRelations !== null && is_array($withRelations)) {
            $query->with($withRelations);
        }

        // ดึงข้อมูลทั้งหมด
        return $query->get();
    }
}
