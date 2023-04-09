<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $roles =  Role::all();
        } else {
            $roles =  Role::where('name', '!=', 'Superadmin')->get();
        }

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $permissions = Permission::all();
        } else {
            $role = Role::findByName('Superadmin');
            $permissions = Permission::whereNotIn('id', $role->permissions()->pluck('permissions.id'))->get();
        }

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        if (!empty($request['permissions'])) {
            $role->syncPermissions($request->input('permissions'));
        }

        return redirect()->route('admin.roles.index')->with('success', 'Successfully created role!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $permissions = Permission::all();
        } else {
            $role = Role::findByName('Superadmin');
            $permissions = Permission::whereNotIn('id', $role->permissions()->pluck('permissions.id'))->get();
        }

        $role = Role::findOrFail($id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
            dd($rolePermissions);
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'permissions' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        if (!empty($request['permissions'])) {
            $role->syncPermissions($request->input('permissions'));
        }
        return redirect()->route('admin.roles.index')->with('success', 'Successfully updated role!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Successfully deleted role!');
    }
}
