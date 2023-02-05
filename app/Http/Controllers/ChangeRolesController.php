<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Role;

class ChangeRolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    //change role
    public function changeRole($id)
    {
        $role = Role::findOrFail($id);

        if (count(auth()->user()->roles) <= 1 )
        {
            return redirect()->back()->with('error', 'Trying to change role to role that you have not assigned.');
        }

        // Changing role
        Session::put('currentRole', $role->role);

        if(Session::get('currentRole') == "Admin")
        {
            return  redirect()->route('admin.dashboard')->with('success', 'Role changed Successfully.');
        }
        if(Session::get('currentRole') == "Department Head")
        {
            return  redirect()->route('departmentHead.home')->with('success', 'Role changed Successfully.');
        }
        if(Session::get('currentRole') == "Registrar")
        {
            return  redirect()->route('registrar.home')->with('success', 'Role changed Successfully.');
        }
        if(Session::get('currentRole') == "Alumni")
        {
            return  redirect()->route('alumnies.home')->with('success', 'Role changed Successfully.');
        }
        else
        {
            return redirect()->back()->with('error', 'Role Changing failed');
        }

    }
}
