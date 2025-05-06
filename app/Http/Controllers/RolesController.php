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
        $authUser = Auth::user();

        // ใช้ Gate ตรวจสอบสิทธิ์การดู role
        // if (Gate::allows('viewAny', Roles::class)) {
            $roles = Roles::all();
            $users = User::all();
            // dd($users);
            return view('roles.index',compact('roles','users'))

            ;
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

        $validated = $request->validated();
        $role = Roles::create($validated);

        return redirect()->route('roles.index')
            ->with('success', 'สร้าง role ใหม่สำเร็จ');
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

        $oldData = $role->getOriginal();
        $newData = $request->validated();
        $diff = array_diff($newData, $oldData);
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

        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'ลบ role สำเร็จ');
    }
}
