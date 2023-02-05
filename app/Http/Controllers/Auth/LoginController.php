<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\RoleUser;
use App\User;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginPage()
    {   
        return view('auth.login');
    }

    public function customLogin(Request $request) 
    {
        if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password ])) 
        {
            $user = User::where('email',$request->email)->first();

            if($user->status == 1) {
                if(count($user->roles) != 0)
                {
                    $firstRole = $user->roles[0]->role;

                    Session::put('currentRole', $user->roles[0]->role);

                    if($firstRole == "Admin")
                    {
                        return  redirect()->route('admin.dashboard')->with('success', 'Signed in Successfully.');
                    }
                    if($firstRole == "Department Head")
                    {
                        return  redirect()->route('departmentHead.home')->with('success', 'Signed in Successfully.');
                    }
                    if($firstRole == "Registrar")
                    {
                        return  redirect()->route('registrar.home')->with('success', 'Signed in Successfully.');
                    }
                    if($firstRole == "Alumni")
                    {
                        return  redirect()->route('alumnies.home')->with('success', 'Signed in Successfully.');
                    }
                    else 
                    {
                        return redirect()->back()->with('error', 'Account Type Incorrect! Pleace Contact Admin');
                    }
                    
                }
                
                return redirect()->back()->with('error', 'Your account is Deactivated! Please contact the admin.');
            }
            else 
            {
                return redirect()->back()->with('error', 'Your account is Deactivated! Please contact the admin.');
            }
        }
        return redirect()->back()->with('error', 'Email or password Incorrect! Please try again.');
    }
}
