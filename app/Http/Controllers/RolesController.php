<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลของผู้ใช้งานที่เข้าสู่ระบบในขณะนั้น (เช่น id, name, email ฯลฯ)
        // แล้วเก็บไว้ในตัวแปร $authUser เพื่อเรียกใช้งานต่อไป
        $authUser = Auth::user();





        // ใช้ Gate ตรวจสอบสิทธิ์การดู role
        // if (Gate::allows('viewAny', Roles::class)) {

        // ดึงข้อมูลทั้งหมดจากตาราง roles แล้วเก็บไว้ในตัวแปร $roles
        // โดยใช้ Eloquent ORM เพื่อให้ได้ Collection ของ role ทั้งหมดในระบบ
        $roles = Roles::all();

        // ดึงข้อมูลทั้งหมดจากตาราง users แล้วเก็บไว้ในตัวแปร $users
        $users = User::all();
        // dd($users); คือ แสดงค่าข้อมูลของตัวแปร $users แบบละเอียด(ใช้สำหรับตรวจสอบค่า)

        // ส่งข้อมูลตัวแปร $roles และ $users ไปยัง view ที่ชื่อว่า 'roles.index' เพื่อให้สามารถแสดงผลบนหน้าเว็บได้
        //compact() = เอาชื่อตัวแปรมาเป็น key แล้วจับค่าของตัวแปรใส่เป็น value ให้เป็น array

        return view('roles.index', compact('roles', 'users'));

        // } else {
        //     return view('error-access');
        // }
    }



    public function create()
    {
        // if (!Gate::allows('create', Roles::class)) {
        //     return redirect()->route('roles.index')
        //         ->with('error', 'คุณไม่มีสิทธิในการสร้าง Role');
        // }

        return view('roles.create');
    }

    public function store(StoreRolesRequest $request)
    {
        // if (!Gate::allows('create', Roles::class)) {
        //     return redirect()->route('roles.index')
        //         ->with('error', 'คุณไม่มีสิทธิในการสร้าง Role');
        // }

        $validated = $request->validated(); // รับข้อมูลที่ถูกตรวจสอบแล้วจากฟอร์ม (ผ่านการ validation) และเก็บไว้ในตัวแปร $validated
        $role = Roles::create($validated); // สร้างข้อมูลใหม่ในตาราง Roles โดยใช้ข้อมูลที่ถูก validated แล้ว


        return redirect()->route('roles.index') // เปลี่ยนเส้นทาง (redirect) ไปที่ route 'roles.index' ซึ่งเป็น URL ของหน้าที่แสดงรายการ roles
            ->with('success', 'สร้าง role ใหม่สำเร็จ'); // ส่งข้อความ 'สร้าง role ใหม่สำเร็จ' ไปพร้อมกับการ redirect โดยเก็บไว้ใน session กับ key 'success'

    }

    public function show(Roles $role)
    {
        // if (!Gate::allows('view', $role)) {
        //     return view('error-access');
        // }

        return view('roles.show', compact('role'));
    }

    public function edit(Roles $role)
    {
        if (!Gate::allows('update', $role)) {
            return redirect()->route('roles.index')
                ->with('error', 'คุณไม่มีสิทธิในการแก้ไข Role นี้');
        }

        return view('roles.edit', compact('role'));
    }

    public function update(Roles $role, UpdateRolesRequest $request)
    {
        if (!Gate::allows('update', $role)) {
            return redirect()->route('roles.index')
                ->with('error', 'คุณไม่มีสิทธิในการแก้ไข Role นี้');
        }


        //ดึงข้อมูลเดิมของ Role จากฐานข้อมูลก่อนการอัปเดตเพื่อเปรียบเทียบการเปลี่ยนแปลง
        $oldData = $role->getOriginal();

        // ดึงข้อมูลที่ผู้ใช้ส่งมา (ผ่าน UpdateRolesRequest)
        $newData = $request->validated();

        //เปรียบเทียบข้อมูลเก่า กับข้อมูลใหม่โดยจะเก็บค่าที่แตกต่างในตัวแปร $diff
        $diff = array_diff($newData, $oldData);

        //อัปเดตข้อมูล Role ในฐานข้อมูลด้วยข้อมูลใหม่
        $role->update($newData);

        return redirect()->route('roles.index')
            ->with('success', 'แก้ไขข้อมูล [' .
                implode(', ', array_keys($diff)) .
                '] เป็น [' . implode(', ', $newData) . '] สำเร็จ');
    }

    public function destroy(Roles $role)
    {
        if (!Gate::allows('delete', $role)) {
            return redirect()->route('roles.index')
                ->with('error', 'คุณไม่มีสิทธิในการลบ Role นี้');
        }

        $role->delete();  //ถ้าผู้ใช้มีสิทธิ์ในการลบ ข้อมูล Role ที่ได้รับจะถูกลบจากฐานข้อมูล
        return redirect()->route('roles.index')
            ->with('success', 'ลบ role สำเร็จ');
    }
}
