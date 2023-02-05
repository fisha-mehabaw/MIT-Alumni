<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\RoleUser;
use App\Department;

class AssignRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        //$this->middleware('isIdNumber');
    }

    // create assign role 
    public function createAssignRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $departments = Department::all();
        $departmentHeadRole = Role::where('role', '=', 'Department Head')->first();

        $data = array(
            'user' => $user,
            'roles' => $roles,
            'departments' => $departments,
            'departmentHeadRole' =>$departmentHeadRole
        );

        return view('admin.assignRole.create')->with($data);
        
    }

    public function storeAssignRole(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|uuid',
        ]);

        $input = $request->all();

        $role = Role::findOrFail($input['role']);
        $user = User::findOrFail($input['user']);
        // check if the user already assigned this role
        $checkIfExist = RoleUser::where('user_id', '=', $user->id)->where('role_id', '=', $role->id)->get();

        if (count($checkIfExist))
        {
            return redirect()->back()->with('error', 'Role already assigned to the User.');
        }

        $departmentHeadRole = Role::where('role', '=', 'Department Head')->first();
        $assignRole = new RoleUser;

        if ($role->id == $departmentHeadRole->id)
        {
            $this->validate($request, [
                'department' => 'required|uuid',
            ]);

            $assignRole->department_id = $input['department'];
        }

        $assignRole->user_id = $user->id;
        $assignRole->role_id = $role->id;

        if ($assignRole->save())
        {
            return redirect()->route('assignRole.assign', ['id'=>$user->id])->with('success', 'User Assigned Role Successfully.');
        }

        return redirect()->route('assignRole.assign', ['id'=>$user->id])->with('error', 'Assign role to User Failed.');
    }

    public function removeAssignedRole($user_id, $role_id)
    {
        $roleUser = RoleUser::where('user_id', '=', $user_id)->where('role_id', '=', $role_id)->first();

        if (count($roleUser) == 0)
        {
            return redirect()->back()->with('error', 'Trying to remove Role that does not assign to the User.');
        }

        if (RoleUser::destroy($roleUser->id))
        {
            return redirect()->route('users.show', ['id'=>$user_id])->with('success', 'Role Removed Successfully.');
        }

        return redirect()->route('users.show', ['id'=>$user_id])->with('error', 'Role Remove Failed.');
    }
}
