<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\MembershipRequest;
use App\Alumni;
use App\Department;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
        $departments = Department::all();
        return view('auth.register')->with('departments',$departments);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|unique:users|max:250',
            'password' => 'required|string',
            'retype_password' => 'required|string',
            'aid' => 'required|string',
            'firstName' => 'required|string',
            'middleName' => 'required|string',
            'lastName' => 'required|string',
            'department_id' => 'required|uuid',
            'graduation_year' => 'required|integer|min:1999',
        ]);

        $input = $request->all();

        // check if the users already exists
        $checkIfUserExist = User::where('email', '=', $input['email'])->get();

        // check if the Membership Request already exists
        $checkIfRequestExist = MembershipRequest::where('email', '=', $input['email'])->get();

        if (count($checkIfRequestExist) > 0 | count($checkIfUserExist) > 0)
        {
            return redirect()->back()->with('error', 'Email already taken.');
        }

        // check if the aid already exists
        $checkIfaidExist = Alumni::where('aid', '=', $input['aid'])->get();

        if (count($checkIfaidExist) > 0)
        {
            return redirect()->back()->with('error', 'Student ID already taken.');
        }

        if ($input['password'] != $input['retype_password'])
        {
            return redirect()->back()->with('error', 'Different password & retype password. Pleace enter the same.');
        }

        $membershipRequest = new MembershipRequest;
        
        $membershipRequest->id = Str::orderedUuid()->toString();
        $membershipRequest->first_name = $input['firstName'];
        $membershipRequest->middle_name = $input['middleName'];
        $membershipRequest->last_name = $input['lastName'];
        $membershipRequest->aid = $input['aid'];
        $membershipRequest->email = $input['email'];
        $membershipRequest->department_id = $input['department_id'];
        $membershipRequest->graduation_year = $input['graduation_year'];
        $membershipRequest->password = bcrypt($input['password']);

        if ($membershipRequest->save())
        {
            return redirect()->route('login')->with('success_code', 2);
        }

        return redirect()->back()->with('error', 'Error occured. Pleace try again.');


    }
}
