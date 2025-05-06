<?php

namespace App\Repositories\Eloquent;

use App\Models\Base;
use App\Models\Dishes; 
use App\Repositories\MasterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

class MasterRepository extends BaseRepository implements MasterRepositoryInterface
//ประกาศว่ารอบรับ Interface โดยเงือนไข Repository จะต้องมีเมธอดทั้งหมดที่ Interface กำหนดไว้
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    private function buildSearchQuery($query, $param, $searchFields)
    {
        if (isset($param['searchValue'])) {

            foreach ($searchFields as $field) {
                $query->orWhere($field, "like", '%' . $param['searchValue'] . '%');
            }
        }

        return $query;
    }

    public function paginate($param, ?array $searchFields = null, ?array $withRelations = null): Collection
{
    // ใช้ data_get เพื่อดึงค่าจาก param และตั้งค่าเริ่มต้น
    $columnName = data_get($param, 'columnName', 'id');  // ถ้าไม่มี 'columnName' ใช้ค่า 'id'
    $columnSortOrder = data_get($param, 'columnSortOrder', 'asc');  // ถ้าไม่มี 'columnSortOrder' ใช้ค่า 'asc'
    $start = data_get($param, 'start', 0);  // ถ้าไม่มี 'start' ใช้ค่าเริ่มต้นที่ 0
    $rowperpage = data_get($param, 'rowperpage', 10);  // ถ้าไม่มี 'rowperpage' ใช้ค่าเริ่มต้นที่ 10

    // เริ่มต้น query
    $query = $this->model->orderBy($columnName, $columnSortOrder);

    // สร้าง query สำหรับการค้นหาข้อมูล
    $query = $this->buildSearchQuery($query, $param, $searchFields);

    // ถ้ามีการระบุ $withRelations จะทำการเพิ่มคำสั่ง 'with' ใน query
    if ($withRelations !== null && is_array($withRelations)) {
        $query->with($withRelations);
    }

    // ใช้ skip และ take เพื่อแบ่งหน้า
    return $query->skip($start)
                 ->take($rowperpage)
                 ->get();
}

public function getAll($param, ?array $searchFields = null, ?array $withRelations = null): Collection
{
    // ใช้ data_get เพื่อดึงค่าจาก param และตั้งค่าเริ่มต้น
    $columnName = data_get($param, 'columnName', 'id');  // ถ้าไม่มี 'columnName' ใช้ค่า 'id'
    $columnSortOrder = data_get($param, 'columnSortOrder', 'asc');  // ถ้าไม่มี 'columnSortOrder' ใช้ค่า 'asc'

    // เริ่มต้น query
    $query = $this->model->orderBy($columnName, $columnSortOrder);

    // สร้าง query สำหรับการค้นหาข้อมูล
    $query = $this->buildSearchQuery($query, $param, $searchFields);

    // ถ้ามีการระบุ $withRelations จะทำการเพิ่มคำสั่ง 'with' ใน query
    if ($withRelations !== null && is_array($withRelations)) {
        $query->with($withRelations);
    }

    // คืนค่าทั้งหมดโดยไม่มีการแบ่งหน้า
    return $query->get();
}



}
