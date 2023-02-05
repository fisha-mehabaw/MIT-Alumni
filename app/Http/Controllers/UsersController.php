<?php

namespace App\Http\Controllers;
use App\User;
use DB;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $users = User::all();

        return view('admin.user.index')->with('users', $users);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'      => 'required|string|email|unique:users|max:250',
            'password'   => 'required|string',
            'firstName'  => 'required|string',
            'middleName' => 'required|string',
            'lastName'   => 'required|string',
        ]);

        $input = $request->all();

        // check if the users already exists
        $checkIfExist = User::where('email', '=', $input['email'])->get();

        if (count($checkIfExist) > 0)
        {
            return redirect()->route('users.create')->with('error', 'User Email already taken.');
        }

        $user = new User;

        $user->id = Str::orderedUuid()->toString();
        $user->first_name   = $input['firstName'];
        $user->middle_name  = $input['middleName'];
        $user->last_name    = $input['lastName'];
        $user->email        = $input['email'];
        $user->password     = bcrypt($input['password']);

        if ($user->save())
        {
            return redirect()->route('users.create')->with('success', 'User Added Successfully.');
        }

        return redirect()->route('users.create')->with('error', 'User Add Failed.');
        
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.detail')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email'         => 'required|string|email|max:250',
            'password'      => 'required|string',
            'firstName'     => 'required|string',
            'middleName'    => 'required|string',
            'lastName'      => 'required|string',
        ]);

        $input = $request->all();

        $user = User::findOrFail($id);

        // check if the new email already exists
        $checkIfExist = User::where('email', '=', $input['email'])->where('id', '!=', $id)->get();

        if (count($checkIfExist) !=0)
        {
            return redirect()->back()->with('error', 'Email already taken.');
        }

        $user->first_name   = $input['firstName'];
        $user->middle_name  = $input['middleName'];
        $user->last_name    = $input['lastName'];
        $user->email        = $input['email'];
        if ($user->password != $input['password'])
        {
            $user->password = bcrypt($input['password']);
        }

        if ($user->save())
        {
            return redirect()->route('users.edit', ['id'=>$id])->with('success', 'User Updated Successfully.');
        }

        return redirect()->route('users.edit', ['id'=>$id])->with('error', 'User Update Failed.');
        
    }

    public function destroy($id)
    {
        if (User::destroy($id))
        {
            DB::table('role_user')->where('user_id', '=', $id)->delete();

            return redirect()->route('users.index')->with('success', 'User Deleted Successfully.');
        }

        return redirect()->route('users.index')->with('error', 'User Delete Failed.');
    }

    // to deactivate Users using ajax
    public function deactivateUser(Request $request) 
    {
        $user = User::findOrFail($request->id);
        $user->status = 0;

        if($user->save())
        {
            return redirect()->route('users.index')->with('success', 'User Deactivated Successfully.');
        }
        
        return redirect()->route('users.index')->with('error', 'User Deactivation Not Successfull.');
        
    }

    // to activate Users
    public function activateUser(Request $request) 
    {
        $user = User::findOrFail($request->id);
        $user->status = 1;

        if($user->save())
        {
            return redirect()->route('users.index')->with('success', 'User Activated Successfully.');
        }
        return redirect()->route('users.index')->with('error', 'User Activation Not Successful.');
    }

}
