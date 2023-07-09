<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:super');
    }

    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Role::create($request->all());

        return redirect(route('admin.roles'))->with(['type' => 'success' , 'message' => 'New Role is stored successfully']);
    }

    public function update(Role $role, Request $request)
    {
        $request->validate(['name' => 'required']);

        $role->update($request->all());

        return redirect(route('admin.roles'))->with(['type' => 'success' , 'message' => 'You have updated Role successfully']);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with(['type' => 'success' , 'message' => 'You have deleted Role successfully']);
    }
}
