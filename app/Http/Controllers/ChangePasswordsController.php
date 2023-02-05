<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;

class ChangePasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    //to get change users password form
    public function changePasswordForm() 
    {
        return view('auth.changePassword');
    }

    //to change users password
    public function changePassword(Request $request)
    {
        // validate input
        $this->validate($request, [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:10',
            'password_confirm' => 'required|string|min:10',
        ]);

        $input = $request->all();
        $user = User::findOrFail(auth()->user()->id);

        if(!Hash::check($input['old_password'], $user->password))
        {
            return redirect()->back()->with('error', 'Your current password does not matches with password you provided. Pleace try again.');
        }
        if($input['old_password'] == $input['password']) 
        {
            return redirect()->back()->with('error', 'New password cannot be same as your current password. Pleace choose different password.');
        }
        if($input['password'] == $input['password_confirm'])
        {
            $user->password = bcrypt($input['password']);

            if($user->save())
            {
                return redirect()->back()->with('success', 'Password changed successfully.');
            }

            return redirect()->back()->with('error', 'Error occured. Pleace try again.');
        }
        
        return redirect()->back()->with('error', 'confirm new password different from new password. Pleace try again.');

    } 

}
