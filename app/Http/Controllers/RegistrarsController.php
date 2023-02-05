<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentRequest;

class RegistrarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        return view('registrar.dashboard');
    }

    // to get Document requests 
    public function documentRequests()
    {
        $documentRequests = DocumentRequest::all();

        return view('registrar.documentRequest.index')->with('documentRequests', $documentRequests);
    }

    // to get Document Request Detail
    public function documentRequestDetail($id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);

        return view('registrar.documentRequest.detail')->with('documentRequest', $documentRequest);
    }

    // change document Request Status
    public function documentRequestStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|string',
        ]);

        $input = $request->all();

        $documentRequest = DocumentRequest::findOrFail($input['id']);

        $documentRequest->status = $input['status'];

        if($input['status'] == "Rejected")
        {
            $this->validate($request, [
                'reasonForRejection' => 'required|string',
            ]);
            $documentRequest->rejectionReason = $input['reasonForRejection'];
        }

        if($input['status'] == "Finished")
        {
            $this->validate($request, [
                'traking_number' => 'string',
            ]);
            $documentRequest->traking_number = $input['traking_number'];
        }

        if ($documentRequest->save())
        {
            return redirect()->route('documentRequest.detail', ['id'=>$documentRequest->id])->with('success', 'Document Requested Status changed Successfully.');
        }

        return redirect()->route('documentRequest.detail', ['id'=>$documentRequest->id])->with('error', 'Document Requested Status changed Failed.');

    }
}
