<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;
use App\Role;
use App\Alumni;

class DepartmentAlumniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        // to get Department head Role id 
        $departmentHeadRole = Role::where('role', '=', 'Department Head')->first();

        // to get department of the department head
        $department = RoleUser::where('user_id', '=', auth()->user()->id)->where('role_id', '=', $departmentHeadRole->id)->first();
        
        // get list of alumnies in the department
        $alumnies = Alumni::where('department_id', '=', $department->department_id)->get();
 
        return view('departmentHead.alumni.index')->with('alumnies', $alumnies);
    }

    public function create()
    {
        return redirect()->back()->with('error', 'Acess denied!');
    }

    public function store(Request $request)
    {
        return redirect()->back()->with('error', 'Acess denied!');
    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('departmentHead.alumni.detail')->with('alumni', $alumni);
    }

    public function edit($id)
    {
        return redirect()->back()->with('error', 'Access denied!');
    }

    public function update(Request $request, $id)
    {
        return redirect()->back()->with('error', 'Access denied!');
    }

    public function destroy($id)
    {
        return redirect()->back()->with('error', 'Access denied!');
    }
}
