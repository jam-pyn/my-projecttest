<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
   
    public function index()
    {
        $authUser = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ทำการล็อกอินอยู่ในปัจจุบัน

        // if (Gate::allows('view', $authUser)) { // เช็คสิทธิ์ของผู้ใช้ (ถูกคอมเมนต์ไว้)

        $users = User::with('role')->paginate(5); // ดึงข้อมูลผู้ใช้จากฐานข้อมูลพร้อมกับข้อมูลของ role (ความสัมพันธ์ระหว่างตาราง User กับ Role) และแบ่งหน้าแสดงผล 5 คนต่อหน้า

        // dd($users); // ใช้คำสั่ง dd() เพื่อตรวจสอบข้อมูลของ $users (ถูกคอมเมนต์ไว้)

        return view('users.index', compact('users')); // ส่งข้อมูลผู้ใช้ไปยัง view 'users.index' และให้ตัวแปร $users อยู่ใน view ด้วย
        // } else {
        //     return view('error-access'); // ถ้าผู้ใช้ไม่มีสิทธิ์ จะทำการแสดงหน้า 'error-access' (ถูกคอมเมนต์ไว้)
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->user_id != 1) {
            return redirect()->route('users.index')
                ->with('error', 'คุณไม่มีสิทธิในการแก้ไข');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // ดึงข้อมูลที่ผ่านการตรวจสอบจาก request
        $validated = $request->validated();

        // สร้าง user ใหม่ด้วยข้อมูลที่ผ่านการตรวจสอบ
        $user = User::create($validated);

        // แสดงข้อความแจ้งเตือน "สร้าง user ใหม่สำเร็จ" และ redirect ไปยังหน้า users.index
        return redirect()->route('users.index')
            ->with('success', 'สร้าง user ใหม่สำเร็จ');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        //  $this->authorize('view', $user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //  $this->authorize('view', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        // ดึงข้อมูล "ข้อมูลเดิม"
        $oldData = $user->getOriginal();

        // ดึงข้อมูล "ข้อมูลที่แก้ไข"
        $newData = $request->validated();

        // เปรียบเทียบข้อมูล
        $diff = array_diff($newData, $oldData);
        $user->update($request->validated());

        // แสดงข้อความ
        return redirect()->route('users.index')
            ->with('success', 'แก้ไขข้อมูล [' .
                implode(', ', array_keys($diff)) .
                '] เป็น [' . implode(', ', $newData) . '] สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'ลบ user ใหม่สำเร็จ');
    }
}
