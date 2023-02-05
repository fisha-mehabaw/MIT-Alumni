<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumni;
use App\Address;
use App\Employment;
use App\PGStudy;
use App\PrivateCompany;
use App\Certificate;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function reports()
    {
        $numbersInsideCountry = Address::where('country', 'Ethiopia')->count();
        $numbersOutsideCountry = Address::where('country', '!=', 'Ethiopia')->count();
        $numbersInsideTigray = Address::where('state', 'Tigray')->count();
        $numbersEmployed = Employment::where('employer', '!=', NULL)->count();
        $numbersPrivateCompany = PrivateCompany::where('company_name', '!=', NULL)->groupBy('alumni_id')->count();

        $data = array(
            'numbersInsideCountry'      => $numbersInsideCountry,
            'numbersOutsideCountry'     => $numbersOutsideCountry,
            'numbersInsideTigray'       => $numbersInsideTigray,
            'numbersEmployed'           => $numbersEmployed,
            'numbersPrivateCompany'    => $numbersPrivateCompany,
        );

        return view('registrar.report')->with($data);
    }
}
