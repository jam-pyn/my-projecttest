<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dishes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *

     */
    protected $fillable = [
        'dish_name',
        'price',
        'category_id',


    ];
    public $timestamps = false;
    public function category()
    {
        // ฟังก์ชันนี้ใช้ดึงข้อมูล category ที่เกี่ยวข้องกับ เมนูอาหาร 1 ออเดอร์
        // ผลลัพธ์ที่ได้จะเป็น Eloquent Relationship object
        return $this->belongsTo(Category::class, 'category_id');

    }



}
