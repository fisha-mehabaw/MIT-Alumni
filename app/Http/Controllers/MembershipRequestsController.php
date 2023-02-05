<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MembershipRequest;
use App\RoleUser;
use App\Role;
use App\User;
use App\Alumni;
use DB;

class MembershipRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $membershipRequests = MembershipRequest::where('status', '=', 0)->get();

        return view('registrar.membershipRequest.index')->with('membershipRequests', $membershipRequests);
    }

    // allow membership request
    public function approveRequest(Request $request)
    {
        
        $this->validate($request, [
            'id' => 'required',
        ]);

        $input = $request->all();
       

        $membershipRequest = MembershipRequest::findOrFail($input['id']);

        // find Alumni role id from Role table
        $alumniRoleID = Role::where('role', '=', 'Alumni')->first();

        $user = new User;

        $user->id = $membershipRequest->id;
        $user->first_name = $membershipRequest->first_name;
        $user->middle_name = $membershipRequest->middle_name;
        $user->last_name = $membershipRequest->last_name;
        $user->email = $membershipRequest->email;
        $user->password = $membershipRequest->password;
        
        
         // assign Alumni role to the user
        $assignRole = new RoleUser;
        $assignRole->user_id = $user->id;
        $assignRole->role_id = $alumniRoleID->id;

        // change the membership request status to Approved/ to 1
        $membershipRequest->status = 1;

        // Alumni detail
        // $alumni = new Alumni;
        // $alumni->id = $membershipRequest->id;
        // $alumni->first_name = $membershipRequest->first_name;
        // $alumni->middle_name = $membershipRequest->middle_name;
        // $alumni->last_name = $membershipRequest->last_name;
        // $alumni->aid = $membershipRequest->aid;
        // $alumni->gender = 'Male';
        // $alumni->marital_status = 'Single';
        // $alumni->dob = '2022-11-18';
        // $alumni->department_id = $membershipRequest->department_id;
        // $alumni->year_of_graduation = $membershipRequest->graduation_year;
        // $alumni->year_of_enrollment = 1995;

       // return $alumni;

        DB::beginTransaction();
        try{
            $user->save();
            $membershipRequest->save();
            $assignRole->save();
            //alumni->save(); // the problem here is alumni->user_id is refering to not created user.. thought it is assigned.
            DB::commit();
            return redirect()->back()->with('success', 'Membership request approved Successfully');
        }catch(Throwable $e){
            DB::rollback();
            echo $e;
            //return redirect()->back()->with('erro', 'Membership request approved faild');
        }
     
    }
    
}

/*   if ($user->save())
        {
            $assignRole = new RoleUser;

            // assign Alumni role to the user
            $assignRole->user_id = $user->id;
            $assignRole->role_id = $alumniRoleID->id;

            // change the membership request status to Approved/ to 1
            $membershipRequest->status = 1;

            if ($membershipRequest->save() && $assignRole->save())
            {
                return redirect()->back()->with('success', 'Membership request approved Successfully');
            }
            else {
                DB::table('users')->where('id', '=', $user->id)->delete();
                return redirect()->back()->with('erro', 'Membership request approved faild');
            }
            
        }
        */