<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use App\Alumni;
use App\Address;
use App\PrivateCompany;

class DepartmentHeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        return view('departmentHead.dashboard');
    }

    // advanced report generation
    public function advancedReport(Request $request)
    {
        $input = $request->all();

        if($input['gender'] == NULL & $input['address'] == NULL & $input['workCatagory'] == NULL & $input['PGStudy'] == NULL)
        {
            return redirect()->back()->with('error', 'No search parameters are specified!');
        }

        $gender = $input['gender'];
        $address = $input['address'];
        $workCatagory = $input['workCatagory'];
        $pgStudy = $input['PGStudy'];

        // to get Department head Role id 
        $departmentHeadRole = Role::where('role', '=', 'Department Head')->first();

        // to get department of the department head
        $departmentHead = RoleUser::where('user_id', '=', auth()->user()->id)->where('role_id', '=', $departmentHeadRole->id)->first();
        
        $department = $departmentHead->department_id;

        if ($workCatagory != NULL & $workCatagory == "Employed")
        {
            $employerCatagory = $input['employerCatagory'];
            $employmentType = $input['employmentType'];
        }
        $searchedAlumnies = null;

        // check if gender and department parameters are not null
        if($gender != NULL & $department != NULL)
        {
            $searchedAlumnies = Alumni::where('gender', $gender)->where('department_id', $department)->get();
        }
        if($gender != NULL & $department == NULL)
        {
            $searchedAlumnies = Alumni::where('gender', $gender)->get();
        }
        if($gender == NULL & $department != NULL)
        {
            $searchedAlumnies = Alumni::where('department_id', $department)->get();
        }

        // if the searched result returns 0 result
        if(count($searchedAlumnies) == 0 & $searchedAlumnies != NULL)
        {
            $data = array(
                'alumnies' => $searchedAlumnies
            );

            return view('departmentHead.alumni.index')->with($data);
        }
        
        // if department and gender parameters are not null
        if($searchedAlumnies != NULL)
        {
            $alumni_ids = array();

            for($i=0; $i<count($searchedAlumnies); $i++)
            {
                $alumni_ids[$i] = $searchedAlumnies[$i]->id;
            }

            // check if the address parameter is not null
            if($address != NULL)
            {
                // check if the value is inside the country
                if($address == "Inside")
                {
                    $searchedResult = Address::where('country', '=', 'Ethiopia')->whereIn('alumni_id', $alumni_ids)->get();
                }
                else
                {
                    $searchedResult = Address::where('country', '!=', 'Ethiopia')->whereIn('alumni_id', $alumni_ids)->get();
                }

                // check if the address result return  0 result
                if (count($searchedResult) == 0)
                {
                    $data = array(
                        'alumnies' => $searchedResult
                    );
        
                    return view('departmentHead.alumni.index')->with($data);
                }

                $alumni_ids = null;
                for ($i=0; $i<count($searchedResult); $i++)
                {
                    $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                }

                // check if the work catagory parameter is not null
                if($workCatagory != NULL)
                {
                    // check if the work catagory is Private owned company
                    if ($workCatagory == "Private Owned")
                    {
                        $searchedResult = PrivateCompany::whereIn('alumni_id', $alumni_ids)
                                                                ->where('company_name', '!=', NULL)
                                                                ->orWhere('company_address', '!=', NULL)->get();                 
                    }
                    else
                    {
                        // check if the employer catagory parameter & employment type parameter is not null
                        if($employerCatagory != NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->where('employment_type', $employmentType)->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory != NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory == NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employment_type', $employmentType)
                                                            ->get();
                        }

                        // both employer catagory and employment type parameters are null
                        if($employerCatagory == NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::where('employer', '!=', NULL)
                                                            ->orWhere('employer_address', '!=', NULL)->get();
                        }

                    }

                    // check if the private company result returns 0 result
                    if(count($searchedResult) == 0)  
                    {
                        $data = array(
                            'alumnies' => $searchedResult
                        );

                        return view('departmentHead.alumni.index')->with($data);
                    }  

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                    
                }

                // if the work catagory parameter is null
                else
                {
                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                }

            }

            // if the address parameter is null
            else
            {
                // check if the work catagory parameter is not null
                if($workCatagory != NULL)
                {
                    // check if the work catagory is Private owned company
                    if ($workCatagory == "Private Owned")
                    {
                        $searchedResult = PrivateCompany::whereIn('alumni_id', $alumni_ids)
                                                                ->where('company_name', '!=', NULL)
                                                                ->orWhere('company_address', '!=', NULL)->get();                 
                    }
                    else
                    {
                        // check if the employer catagory parameter & employment type parameter is not null
                        if($employerCatagory != NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->where('employment_type', $employmentType)->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory != NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory == NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employment_type', $employmentType)
                                                            ->get();
                        }

                        // both employer catagory and employment type parameters are null
                        if($employerCatagory == NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::where('employer', '!=', NULL)
                                                            ->orWhere('employer_address', '!=', NULL)->get();
                        }

                    }

                    // check if the private company result returns 0 result
                    if(count($searchedResult) == 0)  
                    {
                        $data = array(
                            'alumnies' => $searchedResult
                        );
            
                        return view('departmentHead.alumni.index')->with($data);
                    }  

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                }

                // if the work catagory parameter is null
                else
                {
                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    
                        $alumni_ids = null;
                        for ($i=0; $i<count($searchedResult); $i++)
                        {
                            $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                        }

                        $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                        $data = array(
                            'alumnies' => $searchedAlumnies
                        );
                    
                        return view('departmentHead.alumni.index')->with($data);
                    }

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);

                }
            }

        }

        // if department and gender parameters are null
        else
        {
            // check if the address parameter is not null
            if($address != NULL)
            {
                // check if the value is inside the country
                if($address == "Inside")
                {
                    $searchedResult = Address::where('country', 'Ethiopia')->get();
                }
                else
                {
                    $searchedResult = Address::where('country', '!=', 'Ethiopia')->get();
                }

                // check if the address result return  0 result
                if (count($searchedResult) == 0)
                {
                    $data = array(
                        'alumnies' => $searchedResult
                    );
        
                    return view('departmentHead.alumni.index')->with($data);
                }

                $alumni_ids = null;
                for ($i=0; $i<count($searchedResult); $i++)
                {
                    $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                }

                // check if the work catagory parameter is not null
                if($workCatagory != NULL)
                {
                    // check if the work catagory is Private owned company
                    if ($workCatagory == "Private Owned")
                    {
                        $searchedResult = PrivateCompany::whereIn('alumni_id', $alumni_ids)
                                                                ->where('company_name', '!=', NULL)
                                                                ->orWhere('company_address', '!=', NULL)->get();                 
                    }
                    else
                    {
                        // check if the employer catagory parameter & employment type parameter is not null
                        if($employerCatagory != NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->where('employment_type', $employmentType)->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory != NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employer_category', $employerCatagory)
                                                            ->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory == NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::whereIn('alumni_id', $alumni_ids)
                                                            ->where('employment_type', $employmentType)
                                                            ->get();
                        }

                        // both employer catagory and employment type parameters are null
                        if($employerCatagory == NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::where('employer', '!=', NULL)
                                                            ->orWhere('employer_address', '!=', NULL)->get();
                        }

                    }

                    // check if the private company result returns 0 result
                    if(count($searchedResult) == 0)  
                    {
                        $data = array(
                            'alumnies' => $searchedResult
                        );
            
                        return view('departmentHead.alumni.index')->with($data);
                    }  

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                }

                // if the work catagory parameter is null
                else
                {
                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                }

            }

            // if the address parameter is null
            else
            {
                // check if the work catagory parameter is not null
                if($workCatagory != NULL)
                {
                    // check if the work catagory is Private owned company
                    if ($workCatagory == "Private Owned")
                    {
                        $searchedResult = PrivateCompany::where('company_name', '!=', NULL)->orWhere('company_address', '!=', NULL)->get();                 
                    }
                    else
                    {
                        // check if the employer catagory parameter & employment type parameter is not null
                        if($employerCatagory != NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::where('employer_category', $employerCatagory)
                                                            ->where('employment_type', $employmentType)->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory != NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::where('employer_category', $employerCatagory)
                                                            ->get();
                        }

                        // check the employer catagory parameter is not null
                        if($employerCatagory == NULL & $employmentType != NULL)
                        {
                            $searchedResult = Employment::where('employment_type', $employmentType)
                                                            ->get();
                        }

                        // both employer catagory and employment type parameters are null
                        if($employerCatagory == NULL & $employmentType == NULL)
                        {
                            $searchedResult = Employment::where('employer', '!=', NULL)
                                                            ->orWhere('employer_address', '!=', NULL)->get();
                        }

                    }

                    // check if the private company result returns 0 result
                    if(count($searchedResult) == 0)  
                    {
                        $data = array(
                            'alumnies' => $searchedResult
                        );
            
                        return view('departmentHead.alumni.index')->with($data);
                    }  

                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedAlumnies[$i]->alumni_id;
                    }

                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->whereIn('alumni_id', $alumni_ids)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                    
                }

                // if the work catagory parameter is null
                else
                {
                    // check if the PG Study parameter is not null
                    if ($pgStudy != NULL)
                    {
                        $searchedResult = PGStudy::where('degree', $pgStudy)->get();
                    }

                    $alumni_ids = null;
                    for ($i=0; $i<count($searchedResult); $i++)
                    {
                        $alumni_ids[$i] = $searchedResult[$i]->alumni_id;
                    }

                    $searchedAlumnies = Alumni::whereIn('id', $alumni_ids)->get();

                    $data = array(
                        'alumnies' => $searchedAlumnies
                    );
                    
                    return view('departmentHead.alumni.index')->with($data);
                }
            }
        }
    }
}
