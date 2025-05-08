<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;               // ใช้คุณสมบัติในการจัดการ API Token สำหรับผู้ใช้
    use HasFactory;                 // ใช้คุณสมบัติในการสร้างตัวอย่างข้อมูล (Factory) สำหรับการทดสอบหรือการสร้างข้อมูลจำลอง
    use HasProfilePhoto;            // ใช้คุณสมบัติในการจัดการกับรูปโปรไฟล์ของผู้ใช้
    use Notifiable;                 // ใช้คุณสมบัติในการส่งการแจ้งเตือนให้กับผู้ใช้
    use TwoFactorAuthenticatable;   // ใช้คุณสมบัติในการรองรับการยืนยันตัวตนแบบสองขั้นตอน (Two-Factor Authentication)
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     //ถ้าไม่รบุชื่อฟิลด์ใน $fillable จะไม่สามารถอัปเดตข้อมูลในคอลัมน์ ผ่าน orm ได้
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role()  //เรียกไปใช้ ชื่อfunctionต้องตรงกัน
    {
        // ฟังก์ชันนี้ใช้ดึงข้อมูล Role ที่เกี่ยวข้องกับ User 1 คน
        // ผลลัพธ์ที่ได้จะเป็น Eloquent Relationship object
        // กำหนดความสัมพันธ์แบบ "belongs to" ระหว่างโมเดลปัจจุบันและโมเดล Roles โดยใช้คอลัมน์ 'roles_id' ในฐานข้อมูลเพื่อเชื่อมโยง
        return $this->belongsTo(Roles::class, 'roles_id');
    }

    public function checkRole($roles_code)
    {
        
        // ฟังก์ชันนี้ใช้ตรวจสอบว่า User 1 คนมี Role ตรงกับ $roles_code หรือไม่
        // ผลลัพธ์ที่ได้จะเป็น boolean (true หรือ false)
        //strtolower(): ฟังก์ชันนี้ใช้แปลงข้อความให้เป็นตัวพิมพ์เล็กทั้งหมด เพื่อทำให้การเปรียบเทียบไม่คำนึงถึงตัวพิมพ์ใหญ่/พิมพ์เล็ก
        //==: การเปรียบเทียบค่าระหว่างตัวแปรทั้งสองหลังจากที่แปลงเป็นตัวพิมพ์เล็กแล้ว
        return strtolower($this->role->roles_code) == strtolower($roles_code);
    }
}
