<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumni;
use App\Address;
use App\Employment;
use App\PGStudy;
use App\PrivateCompany;
use App\Certificate;
use App\Department;
use DB;
use Illuminate\Support\Str;


class AlumniProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        $alumni = Alumni::where('user_id', auth()->user()->id)->first();

        if (!$alumni)
        {
            return redirect()->route('alumniesProfile.create');
        }
        else
        {
            return redirect()->route('alumniesProfile.show', ['id'=>$alumni->id]);
        }

    }

    public function create()
    {
        $departments = Department::all();

        return view('alumnies.alumniProfile.create')->with('departments', $departments);
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

        $pgStudyModels = collect();
        $certificateModels = collect();

        $model = $this->mapper($request, true);

        // alumni personal information
        $alumni = new Alumni();

        //$alumni->user_id = auth()->user()->id;
        $alumni->user_id = 14;
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
                return redirect()->route('alumniesProfile.index')->with('success', 'Alumni information Added Successfully.');
            }
            else
            {
                DB::table('alumnis')->where('id', '=', $alumni->id)->delete();

                return redirect()->route('alumniesProfile.create')->with('error', 'Alumni information Add Failed.');
            }
        }

        return redirect()->route('alumniesProfile.create')->with('error', 'Alumni information Add Failed.');

    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('alumnies.alumniProfile.detail')->with('alumni', $alumni);
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $departments = Department::all();

        $data = array(
            'alumni' => $alumni,
            'departments' => $departments
        );
        return view('alumnies.alumniProfile.edit')->with($data);
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
                return redirect()->route('alumniesProfile.edit', ['id'=>$id])->with('success', 'Alumni information Updated Successfully.');
            }

        return redirect()->route('alumniesProfile.edit', ['id'=>$id])->with('error', 'Alumni information Update Failed.');

    }

    public function destroy($id)
    {
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function destroyPgStudy($id)
    {
        PGStudy::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Record deleted Successfully.');
    }

    public function destroyCertificate($id)
    {
        Certificate::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Record deleted Successfully.');
    }

    protected function mapper($request, $is_create = false)
    {
        if($is_create == true)
        {
            $model = new Alumni;
            $model->id = (string) Str::uuid();
        }else{
            $model = Alumni::findOrFail($request->id);
        }
        $model->user_id = auth()->user()->id;
        $model->aid = $request->aid;
        $model->first_name = $request->firstName;
        $model->middle_name = $request->middleName;
        $model->last_name = $request->lastName;
        $model->dob = $request->dob;
        $model->gender = $request->gender;
        $model->marital_status = $request->maritalStatus;
        $model->year_of_enrollment = $request->enrollmentYear;
        $model->year_of_graduation = $request->graduationYear;
        $model->department_id = $request->department;
        return $model;
    }

    private function addressMapper($alumniId, $request, $is_create = false)
    {
        if($is_create == true)
        {
            $model = new Address;
            $model->id = (string) Str::uuid();
        }else{
            $model = Address::findOrFail($request->id);
        }
        $model->alumni_id = $alumniId;
        $model->country = $request->country;
        $model->state = $request->state;
        $model->officephone = $request->officephone;
        $model->phone1 = $request->phone1;
        $model->phone2 = $request->phone2;
        $model->email = $request->email;
        $model->facebook = $request->facebook;
        $model->linkedin = $request->linkedin;
        return $model;
    }

    private function employmentMapper($alumniId, $request, $is_create = false)
    {
        if($is_create == true)
        {
            $model = new Employment;
            $model->id = (string) Str::uuid();
        }else{
            $model = Employment::findOrFail($request->id);
        }
        $model->alumni_id = $alumniId;
        $model->employer = $request->employer;
        $model->employer_address = $request->empaddress;
        $model->employer_category = $request->empcategory;
        $model->position = $request->position;
        $model->salary = $request->salary;
        $model->employment_date = $request->empdate;
        $model->employment_type = $request->emptype;
        $model->employment_info = $request->empinfo;
        return $model;
    }

    private function privateCompanyMapper($alumniId, $request, $is_create = false)
    {
        if($is_create == true)
        {
            $model = new PrivateCompany;
            $model->id = (string) Str::uuid();
        }else{
            $model = PrivateCompany::findOrFail($request->id);
        }
        $model->alumni_id = $alumniId;
        $model->company_name = $request->companyname;
        $model->company_address = $request->companyaddress;
        $model->company_category = $request->companycategory;
        $model->establishment_date = $request->establishmentdate;
        $model->website_url = $request->website;
        return $model;
    }

    private function pgStudyMapper($alumniId, $request, $is_create = false, &$pgStudyModels)
    {
        $degree = $request->degree;
        $specialization = $request->specialization;
        $granting_organization = $request->grant;
        $pg_address = $request->pgcountry;
        $university = $request->university;
        $enrolment_year = $request->enrollmentyear;
        $graduation_year = $request->mscgraduationyear;
        $goals_achieved = $request->goalsachieved;

        for($i = 0 ; $i < count($degree); $i++)
        {
            if($is_create == true)
            {
                $model = new PGStudy;
                $model->id = (string) Str::uuid();
            }else{
                $model = PGStudy::findOrFail($request->id);
            }

            $model->alumni_id = $alumniId;
            $model->degree = $degree[$i];
            $model->specialization = $specialization[$i];
            $model->granting_organization = $granting_organization[$i];
            $model->address = $pg_address[$i];
            $model->university = $university[$i];
            $model->enrolment_year = $enrolment_year[$i];
            $model->graduation_year = $graduation_year[$i];
            $model->goals_achieved = $goals_achieved[$i];

            $pgStudyModels.push($model);
        }
    }

    private function certificateMapper($alumniId, $request, $is_create = false, &$certificateModels)
    {
        $certificate_name = $request->certificatename;
        $provider_name = $request->providername;
        $provider_address = $request->provideraddress;
        $duration = $request->duration;
        $skills = $request->skills;
        $certification_date = $request->certificationdate;

        for($i = 0 ; $i < count($certificate_name); $i++)
        {
            if($is_create == true)
            {
                $model = new Certificate;
                $model->id = (string) Str::uuid();
            }else{
                $model = Certificate::findOrFail($request->id);
            }

            $model->alumni_id = $alumniId;
            $model->certificate_name = $certificate_name[$i];
            $model->provider_name = $provider_name[$i];
            $model->provider_address = $provider_address[$i];
            $model->duration = $duration[$i];
            $model->skills = $skills[$i];
            $model->certification_date = $certification_date[$i];

            $certificateModels.push($model);
        }
    }
}
