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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();

        // if (Gate::allows('view', $authUser)) {

            $users = User::with('role')->paginate(5);
            // dd($users);
            return view('users.index', compact('users'));
        // } else {
        //     return view('error-access');
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
        //  เรียกใช้ Policy (optional)
        //  $this->authorize('view', $user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //  เรียกใช้ Policy (optional)
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
