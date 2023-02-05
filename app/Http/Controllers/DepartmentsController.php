<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Department;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $departments = Department::all();

        return view('admin.department.index')->with('departments', $departments);
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        // check if the department already exists
        $checkIfExist = Department::where('name', '=', $input['name'])->get();
        if (count($checkIfExist) > 0)
        {
            return redirect()->route('departments.create')->with('error', 'Department name already taken.');
        }

        $department = new Department;

        $department->id = Str::orderedUuid()->toString();
        $department->name = $input['name'];
        if ($department->save())
        {
            return redirect()->route('departments.create')->with('success', 'Department Added Successfully.');
        }

        return redirect()->route('departments.create')->with('error', 'Department Add Failed.');
    }

    public function show($id)
    {
        return redirect()->back()->with('error', 'Access Denied!');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.department.edit')->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $department = Department::findOrFail($id);

        $department->name = $input['name'];

        if ($department->save())
        {
            return redirect()->route('departments.edit', ['id'=>$id])->with('success', 'Department Updated Successfully.');
        }

        return redirect()->route('departments.edit', ['id'=>$id])->with('error', 'Department Update Failed.');        
    }

    public function destroy($id)
    {
        if (Department::destroy($id))
        {
            return redirect()->route('departments.index')->with('success', 'Department Deleted Successfully.');
        }

        return redirect()->route('departments.index')->with('error', 'Department Delete Failed.');
    }
}
