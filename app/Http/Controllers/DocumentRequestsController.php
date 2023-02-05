<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentRequest;
use App\Alumni;
use Illuminate\Support\Facades\Redirect;

class DocumentRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {

        $alumni = Alumni::where('user_id', '=', auth()->user()->id)->first();

        if (!$alumni)
        {
            return redirect()->back()->with('error', 'Pleace fill the alumni Profile first.');
        }
        
        $documentRequests = DocumentRequest::where('alumni_id', auth()->user()->alumni->id)->get();

        return view('alumnies.documentRequest.index')->with('documentRequests', $documentRequests);
    }

    public function create()
    {
        return view('alumnies.documentRequest.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string',
            'program' => 'required|string',
            'address_name' => 'nullable|string',
            'address_pobox' => 'nullable|string',
            'address_town' => 'nullable|string',
            'address_region' => 'nullable|string',
            'address_country' => 'nullable|string',
        ]);

        $input = $request->all();

        // check if the request already exists
        $checkIfExist = DocumentRequest::where('request_type', $input['type'])->where('alumni_id', auth()->user()->alumni->id)->get();

        if (count($checkIfExist) > 0)
        {
            return redirect()->route('documentRequest.create')->with('error', 'Document already Requested.');
        }

        $documentRequest = new DocumentRequest;

        $documentRequest->request_type = $input['type'];
        $documentRequest->programme = $input['program'];
        $documentRequest->address_name = $input['address_name'];
        $documentRequest->address_pobox = $input['address_pobox'];
        $documentRequest->address_town = $input['address_town'];
        $documentRequest->address_region = $input['address_region'];
        $documentRequest->address_country = $input['address_country'];
        $documentRequest->alumni_id = auth()->user()->alumni->id;
        $documentRequest->request_date = date('Y-m-d');

        if ($documentRequest->save())
        {
            return redirect()->route('documentRequest.create')->with('success', 'Document Requested Successfully.');
        }

        return redirect()->route('roles.create')->with('error', 'Document Requeste Failed.');
    }

    public function show($id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);

        return view('alumnies.documentRequest.detail')->with('documentRequest', $documentRequest);
    }

    public function edit($id)
    {
        return redirect()->back()->with('error', 'Access Denied.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->back()->with('error', 'Access Denied.');
    }

    public function destroy($id)
    {
        if (DocumentRequest::destroy($id))
        {
            return redirect()->route('documentRequest.index')->with('success', 'Document Request Deleted Successfully.');
        }

        return redirect()->route('documentRequest.index')->with('error', 'Document Request Delete Failed.');
    }
}
