<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index')->with('roles', $roles);
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        $input = $request->all();

        // check if the role already exists
        $checkIfExist = Role::where('role', '=', $input['role'])->get();

        if (count($checkIfExist) > 0)
        {
            return redirect()->route('roles.create')->with('error', 'Role already taken.');
        }

        $role = new Role;

        $role->id = Str::orderedUuid()->toString();
        $role->role = $input['role'];

        if ($role->save())
        {
            return redirect()->route('roles.create')->with('success', 'Role Added Successfully.');
        }

        return redirect()->route('roles.create')->with('error', 'Role Add Failed.');
        
    }

    public function show($id)
    {
        return redirect()->back()->with('error', 'Access Denied!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit')->with('role', $role);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        $input = $request->all();

        $role = Role::findOrFail($id);

        $role->role = $input['role'];

        if ($role->save())
        {
            return redirect()->route('roles.edit', ['id'=>$id])->with('success', 'Role Updated Successfully.');
        }

        return redirect()->route('roles.edit', ['id'=>$id])->with('error', 'Role Update Failed.');
    }

    public function destroy($id)
    {
        if (Role::destroy($id))
        {
            return redirect()->route('roles.index')->with('success', 'Role Deleted Successfully.');
        }

        return redirect()->route('roles.index')->with('error', 'Role Delete Failed.');
    }
}
