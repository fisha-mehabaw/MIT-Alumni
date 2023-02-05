@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Document Requests
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('documentRequests') }}">Document Request</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">List of Document Requests</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="documentRequestID" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alumni ID</th>
                                    <th>Full Name</th>
                                    <th>Programme</th>
                                    <th>Request Type</th>
                                    <th>Request Status</th>
                                    <th>Request Date</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @if(count($documentRequests) > 0)
                                    @php($count = 1)
                                    @foreach ($documentRequests as $documentRequest)
                                        <tr>
                                            <td width=2%>{{ $count++ }}</td>
                                            <td>{{ $documentRequest->alumni->aid }}</td>
                                            <td>{{ $documentRequest->alumni->first_name }} &nbsp; {{ $documentRequest->alumni->middle_name }} &nbsp; {{ $documentRequest->alumni->last_name }}</td>
                                            <td>{{ $documentRequest->programme }}</td>
                                            <td>{{ $documentRequest->request_type }}</td>
                                            <td>{{ $documentRequest->status }}</td>
                                            <td>{{ $documentRequest->request_date }}</td>
                                            <td>
                                                <a href="{!! route('documentRequest.detail', ['id'=>$documentRequest->id]) !!}" class="" id ="">Detail <span class="fa fa-link"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            
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

<script type="text/javascript">
    $('#documentRequestID').dataTable({searching: true, paging: true, info: true, pageLength: 50});
</script>
@endsection
