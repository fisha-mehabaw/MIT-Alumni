@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Document Requests
        <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('documentRequest.index') }}">Document Request</a></li>
        </ol>
    </section>
    

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">Document Request Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Programme:</th>
                            <td width=65%>{{ $documentRequest->programme }}</td>
                        </tr>

                        <tr>
                            <th>Request Type:</th>
                            <td>{{ $documentRequest->request_type }}</td>
                        </tr>

                        <tr>
                            <th>Request Status:</th>
                            <td>{{ $documentRequest->status }}</td>
                        </tr>
                        @if($documentRequest->status == "Rejected")
                            <tr>
                                <th>Rejection Reason:</th>
                                <td>{{ $documentRequest->rejectionReason }}</td>
                            </tr>
                        @endif

                        @if($documentRequest->status == "Finished")
                            <tr>
                                <th>Traking Number:</th>
                                <td>{{ $documentRequest->traking_number }}</td>
                            </tr>
                        @endif
                        
                        <tr>
                            <th>Request Date:</th>
                            <td>{{ $documentRequest->request_date }}</td>
                        </tr>
                        
                        <tr>
                            <th>Destination Address Institute/University/Organization:</th>
                            <td>{{ $documentRequest->address_name }}</td>
                        </tr>
                        
                        <tr>
                            <th>P.o.Box:</th>
                            <td>{{ $documentRequest->address_pobox }}</td>
                        </tr>

                        <tr>
                            <th>Town:</th>
                            <td>{{ $documentRequest->address_town }}</td>
                        </tr>
                        
                        <tr>
                            <th>Region/State:</th>
                            <td>{{ $documentRequest->address_region }}</td>
                        </tr>

                        <tr>
                            <th>Country:</th>
                            <td>{{ $documentRequest->address_country }}</td>
                        </tr>
                
                    </table>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>
@endsection
