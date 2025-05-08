<?php

// กำหนด namespace สำหรับคลาสนี้
namespace App\Repositories\Eloquent;

// นำเข้า (use) คลาสที่จำเป็น
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;  // นำเข้า BaseRepository สำหรับการใช้งานฟังก์ชันพื้นฐานใน repository
use App\Repositories\DishRepositoryInterface;  // นำเข้า DishRepositoryInterface เพื่อให้คลาสนี้ต้อง implement ฟังก์ชันจาก interface นี้
use App\Models\Dishes;  // นำเข้าโมเดล Dishes ที่ใช้ในการทำงานกับข้อมูลเมนูอาหารในฐานข้อมูล


class DishRepository extends MasterRepository implements DishRepositoryInterface
{
    /**
     * คอนสตรัคเตอร์ของ DishRepository
     *
     * @param Dishes $model
     * รับโมเดล Dishes เพื่อให้สามารถทำงานกับข้อมูลเมนูอาหารได้ 
     */
    public function __construct(Dishes $model)
    {
        // เรียกคอนสตรัคเตอร์ของคลาสที่สืบทอดมา (MasterRepository) โดยส่งโมเดล Dishes ให้
        parent::__construct($model); // ส่ง Dishes model เข้ามาที่ BaseRepository
    }
}
