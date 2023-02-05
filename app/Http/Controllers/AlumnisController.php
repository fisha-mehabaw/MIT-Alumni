<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Alumni;
use App\Address;
use App\Employment;
use App\PGStudy;
use App\PrivateCompany;
use App\Certificate;
use App\User;
use App\Role;
use App\RoleUser;
use DB;

class AlumnisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $alumnies = Alumni::all();
        $departments = Department::all();

        $data = array(
            'departments' => $departments,
            'alumnies' => $alumnies
        );

        return view('registrar.alumni.index')->with($data);
    }

    public function create()
    {
        $departments = Department::all();

        return view('registrar.alumni.create')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'aid' => 'required|string|unique:alumnis|max:250',
            'firstName' => 'required|string',
            'middleName' => 'required|string',
            'lastName' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'maritalStatus' => 'required|string',
            'department' => 'required|integer',
            'enrollmentYear' => 'required|integer',
            'graduationYear' => 'required|integer',
            'country' => 'required|string',
            'state' => 'required|string',
            'phone1' => 'required|string',
            'email' => 'required|string|email',
        ]);

        $input = $request->all();

        $alumniRoleID = Role::where('role', '=', 'Alumni')->first();

        // check if the Alumni information already exists
        $checkIfExists = Alumni::where('aid', '=', $input['aid'])->get();

        if (count($checkIfExists))
        {
            return redirect()->back()->with('error', 'Alumni information already Exist.');
        }

        // alumni personal information
        $alumni = new Alumni();

        // check if the user Account already exists
        $checkIfUserAccountExist = User::where('email', '=', $input['email'])->get();

        // create user Account & assigne Alumni role to the Alumni
        if (count($checkIfUserAccountExist) == 0)
        {
            $user = new User;

            $user->first_name = $input['firstName'];
            $user->middle_name = $input['middleName'];
            $user->last_name = $input['lastName'];
            $user->email = $input['email'];
            $user->password = bcrypt('123456');

            if ($user->save())
            {
                $assignRole = new RoleUser;

                $assignRole->user_id = $user->id;
                $assignRole->role_id = $alumniRoleID->id;

                $assignRole->save();

                $alumni->user_id = $user->id;
            }
        }
        else{
            $alumni->user_id = $checkIfUserAccountExist[0]->id;

            $assignRole = new RoleUser;

            $assignRole->user_id = $checkIfUserAccountExist[0]->id;
            $assignRole->role_id = $alumniRoleID->id;

            $assignRole->save();
        }

        //$alumni->user_id = $input['user'];
        $alumni->aid = $input['aid'];
        $alumni->first_name = $input['firstName'];
        $alumni->middle_name = $input['middleName'];
        $alumni->last_name = $input['lastName'];
        $alumni->dob = \Carbon\Carbon::parse($input['dob'])->format('Y/m/d');
        $alumni->gender = $input['gender'];
        $alumni->marital_status = $input['maritalStatus'];
        $alumni->year_of_enrollment = $input['enrollmentYear'];
        $alumni->year_of_graduation = $input['graduationYear'];
        $alumni->department_id = $input['department'];

        if ($alumni->save())
        {
            // alumni address information
            $address = new Address();

            $address->alumni_id = $alumni->id;
            $address->country = $input['country'];
            $address->state = $input['state'];
            $address->officephone = $input['officephone'];
            $address->phone1 = $input['phone1'];
            $address->phone2 = $input['phone2'];
            $address->email = $input['email'];
            $address->facebook = $input['facebook'];
            $address->linkedin = $input['linkedin'];

            // alumni employment information
            $employment = new Employment();

            $employment->alumni_id = $alumni->id;
            $employment->employer = $input['employer'];
            $employment->employer_address = $input['empaddress'];
            $employment->employer_category = $input['empcategory'];
            $employment->position = $input['position'];
            $employment->salary = $input['salary'];
            $employment->employment_date = \Carbon\Carbon::parse($input['empdate'])->format('Y/m/d');
            $employment->employment_type = $input['emptype'];
            $employment->employment_info = $input['empinfo'];

            // alumni private company information
            $pcompany = new PrivateCompany();

            $pcompany->alumni_id = $alumni->id;
            $pcompany->company_name = $input['companyname'];
            $pcompany->company_address = $input['companyaddress'];
            $pcompany->company_category = $input['companycategory'];
            $pcompany->establishment_date = \Carbon\Carbon::parse($input['establishmentdate'])->format('Y/m/d');
            $pcompany->website_url = $input['website'];

            // alumni pg study information

            $degree = $input['degree'];
            $specialization = $input['specialization'];
            $granting_organization = $input['grant'];
            $pg_address = $input['pgcountry'];
            $university = $input['university'];
            $enrolment_year = $input['enrollmentyear'];
            $graduation_year = $input['mscgraduationyear'];
            $goals_achieved = $input['goalsachieved'];

            for($i = 0; $i < count($degree); $i++) 
            {
                $pgStudy[] = [
                    'alumni_id'             => $alumni->id,
                    'degree'                => $degree[$i],
                    'specialization'        => $specialization[$i],
                    'granting_organization' => $granting_organization[$i],
                    'address'               => $pg_address[$i],
                    'university'            => $university[$i],
                    'enrolment_year'        => $enrolment_year[$i],
                    'graduation_year'       => $graduation_year[$i],
                    'goals_achieved'        => $goals_achieved[$i]
                ];
            }

            // alumni certificate information

            $certificate_name = $input['certificatename'];
            $provider_name = $input['providername'];
            $provider_address = $input['provideraddress'];
            $duration = $input['duration'];
            $skills = $input['skills'];
            $certification_date = $input['certificationdate'];

            for($i = 0; $i < count($certificate_name); $i++) 
            {
                $certificate[] = [
                    'alumni_id'          => $alumni->id,
                    'certificate_name'   => $certificate_name[$i],
                    'provider_name'      => $provider_name[$i],
                    'provider_address'   => $provider_address[$i],
                    'duration'           => $duration[$i],
                    'skills'             => $skills[$i],
                    'certification_date' => \Carbon\Carbon::parse($certification_date[$i])->format('Y/m/d')
                ];
            }


            if($address->save() & $employment->save() & $pcompany->save() & PGStudy::insert($pgStudy) & Certificate::insert($certificate))
            {
                return redirect()->route('alumnies.create')->with('success', 'Alumni information Added Successfully.');
            }

            return redirect()->route('alumnies.create')->with('error', 'Alumni information Add Failed.');


        }

        return redirect()->route('alumnies.create')->with('error', 'Alumni information Add Failed.');

    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('registrar.alumni.detail')->with('alumni', $alumni);
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $departments = Department::all();

        $data = array(
            'alumni' => $alumni,
            'departments' => $departments
        );
        return view('registrar.alumni.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'aid' => 'required|string|max:250',
            'firstName' => 'required|string',
            'middleName' => 'required|string',
            'lastName' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'maritalStatus' => 'required|string',
            'department' => 'required|integer',
            'enrollmentYear' => 'required|integer',
            'graduationYear' => 'required|integer',
            'country' => 'required|string',
            'state' => 'required|string',
            'phone1' => 'required|string',
            'email' => 'required|string|email',
        ]);

        $input = $request->all();

        $alumni = Alumni::findOrFail($id);

        // check if the new Alumni information already exists
        $checkIfExists = Alumni::where('aid', '=', $input['aid'])->where('id', '!=', $id)->get();

        if (count($checkIfExists))
        {
            return redirect()->back()->with('error', 'Alumni ID already Exists..');
        }

        $alumni->aid = $input['aid'];
        $alumni->first_name = $input['firstName'];
        $alumni->middle_name = $input['middleName'];
        $alumni->last_name = $input['lastName'];
        $alumni->dob = \Carbon\Carbon::parse($input['dob'])->format('Y/m/d');
        $alumni->gender = $input['gender'];
        $alumni->marital_status = $input['maritalStatus'];
        $alumni->year_of_enrollment = $input['enrollmentYear'];
        $alumni->year_of_graduation = $input['graduationYear'];
        $alumni->department_id = $input['department'];


        // alumni address information
        $address = Address::where('alumni_id', '=', $alumni->id)->first();

        $address->country = $input['country'];
        $address->state = $input['state'];
        $address->officephone = $input['officephone'];
        $address->phone1 = $input['phone1'];
        $address->phone2 = $input['phone2'];
        //$address->email = $input['email'];
        $address->facebook = $input['facebook'];
        $address->linkedin = $input['linkedin'];

        if ($address->email != $input['email'])
        {
            $address->email = $input['email'];

            $userAccount = User::find($alumni->user_id);

            if (count($userAccount) == 0)
            {
                return redirect()->back()->with('error', 'Trying to edit file that does not exist');
            }

            $userAccount->email = $input['email'];

            $userAccount->save();

        }


        // alumni employment information
        $employment = Employment::where('alumni_id', '=', $alumni->id)->first();

        $employment->employer = $input['employer'];
        $employment->employer_address = $input['empaddress'];
        $employment->employer_category = $input['empcategory'];
        $employment->position = $input['position'];
        $employment->salary = $input['salary'];
        $employment->employment_date = \Carbon\Carbon::parse($input['empdate'])->format('Y/m/d');
        $employment->employment_type = $input['emptype'];
        $employment->employment_info = $input['empinfo'];

        // alumni private company information
        $pcompany = PrivateCompany::where('alumni_id', '=', $alumni->id)->first();

        $pcompany->company_name = $input['companyname'];
        $pcompany->company_address = $input['companyaddress'];
        $pcompany->company_category = $input['companycategory'];
        $pcompany->establishment_date = \Carbon\Carbon::parse($input['establishmentdate'])->format('Y/m/d');
        $pcompany->website_url = $input['website'];

        // alumni pg study information
        $pgstudy = PGStudy::where('alumni_id', '=', $alumni->id)->get();

        $degree = $input['degree'];
        $specialization = $input['specialization'];
        $granting_organization = $input['grant'];
        $pg_address = $input['pgcountry'];
        $university = $input['university'];
        $enrolment_year = $input['enrollmentyear'];
        $graduation_year = $input['mscgraduationyear'];
        $goals_achieved = $input['goalsachieved'];

        if(count($degree) == count($pgstudy))
        {
            for ($i=0; $i<count($pgstudy); $i++)
            {
                DB::table('p_g_studies')
                    ->where('id', $pgstudy[$i]->id)
                    ->update(['degree' => $degree[$i],
                              'specialization' => $specialization[$i],
                              'granting_organization' => $granting_organization[$i],
                              'address' => $pg_address[$i],
                              'university' => $university[$i],
                              'enrolment_year' => $enrolment_year[$i],
                              'graduation_year' => $graduation_year[$i],
                              'goals_achieved' => $goals_achieved[$i]
                              ]);
            }
        }
        else
        {
            for ($i=0; $i<count($pgstudy); $i++)
            {
                DB::table('p_g_studies')
                    ->where('id', $pgstudy[$i]->id)
                    ->update(['degree' => $degree[$i],
                              'specialization' => $specialization[$i],
                              'granting_organization' => $granting_organization[$i],
                              'address' => $pg_address[$i],
                              'university' => $university[$i],
                              'enrolment_year' => $enrolment_year[$i],
                              'graduation_year' => $graduation_year[$i],
                              'goals_achieved' => $goals_achieved[$i]
                              ]);
            }

            for($i=count($pgstudy); $i<count($degree); $i++)
            {
                DB::table('p_g_studies')->insert([
                    'alumni_id'             => $alumni->id,
                    'degree'                => $degree[$i],
                    'specialization'        => $specialization[$i],
                    'granting_organization' => $granting_organization[$i],
                    'address'               => $pg_address[$i],
                    'university'            => $university[$i],
                    'enrolment_year'        => $enrolment_year[$i],
                    'graduation_year'       => $graduation_year[$i],
                    'goals_achieved'        => $goals_achieved[$i]
                ]);
                
            }
        }

        // alumni certificate information
        $certificate = Certificate::where('alumni_id', '=', $alumni->id)->get();

        $certificate_name = $input['certificatename'];
        $provider_name = $input['providername'];
        $provider_address = $input['provideraddress'];
        $duration = $input['duration'];
        $skills = $input['skills'];
        $certification_date = $input['certificationdate'];
        
        if(count($certificate_name) == count($certificate))
        {
            for ($i=0; $i<count($certificate); $i++)
            {
                DB::table('certificates')
                    ->where('id', $certificate[$i]->id)
                    ->update([
                            'certificate_name'   => $certificate_name[$i],
                            'provider_name'      => $provider_name[$i],
                            'provider_address'   => $provider_address[$i],
                            'duration'           => $duration[$i],
                            'skills'             => $skills[$i],
                            'certification_date' => \Carbon\Carbon::parse($certification_date[$i])->format('Y/m/d')
                            ]);
            }
        }
        else
        {
            for ($i=0; $i<count($certificate); $i++)
            {
                DB::table('certificates')
                    ->where('id', $certificate[$i]->id)
                    ->update([
                            'certificate_name'   => $certificate_name[$i],
                            'provider_name'      => $provider_name[$i],
                            'provider_address'   => $provider_address[$i],
                            'duration'           => $duration[$i],
                            'skills'             => $skills[$i],
                            'certification_date' => \Carbon\Carbon::parse($certification_date[$i])->format('Y/m/d')
                            ]);
            }

            for($i=count($certificate); $i<count($certificate_name); $i++)
            {
                DB::table('certificates')->insert([
                    'alumni_id'             => $alumni->id,
                    'certificate_name'   => $certificate_name[$i],
                    'provider_name'      => $provider_name[$i],
                    'provider_address'   => $provider_address[$i],
                    'duration'           => $duration[$i],
                    'skills'             => $skills[$i],
                    'certification_date' => \Carbon\Carbon::parse($certification_date[$i])->format('Y/m/d')
                ]);
                
            }
        }



        if($alumni->save() & $address->save() & $employment->save() & $pcompany->save())
            {
                return redirect()->route('alumnies.edit', ['id'=>$id])->with('success', 'Alumni information Updated Successfully.');
            }

        return redirect()->route('alumnies.edit', ['id'=>$id])->with('error', 'Alumni information Update Failed.');

    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $userAccount = User::findOrFail($alumni->user_id);

        $userAccount->status = false;
        if($userAccount->save())
        {
            if(Alumni::destroy($id))
            {   
                return redirect()->route('alumnies.index')->with('success', 'Alumni Deleted Successfully.');
            }
            return redirect()->back()->with('error', 'Error occured while deleting a alumni.');

        }
        return redirect()->back()->with('error', 'Error occured while deleting a alumni.');

    }
}
