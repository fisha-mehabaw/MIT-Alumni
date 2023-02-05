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
        <li class="active"><a href="{{ route('documentRequest.index') }}">Document Request</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
                <div class="text-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"> 
                            <a class="btn btn-success" href="{{ route('documentRequest.create') }}" > <i class="fa fa-plus"></i> Request Document</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">List of Document Requests</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="documentRequests" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Programme</th>
                            <th>Request Type</th>
                            <th>Request Date</th>
                            <th>Response </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($documentRequests) > 0)
                            @php($count = 1)
                            @foreach ($documentRequests as $documentRequest)
                                <tr>
                                    <td width=2%>{{ $count++ }}</td>
                                    <td>{{ $documentRequest->programme }}</td>
                                    <td>{{ $documentRequest->request_type }}</td>
                                    <td>{{ $documentRequest->request_date }}</td>
                                    <td>{{ $documentRequest->status }} &nbsp; &nbsp;
                                        @if($documentRequest->status == "Rejected")
                                        <a href="#" data-toggle="modal" data-target="#RejectionReason{{$documentRequest->id}}"> View Rejection Reason</span> </a>
                                        @endif
                                        @if($documentRequest->status == "Finished")
                                        <a href="#" data-toggle="modal" data-target="#TrakingNumber{{$documentRequest->id}}"> View Postal Traking Number</span> </a>
                                        @endif
                                    </td>
                                    <td width=15%>
                                        <a href="{!! route('documentRequest.show',$documentRequest->id) !!}" class="" id ="">View <span class="fa fa-link"></span></a>
                                        <a href="#" data-toggle="modal" data-target="#delete{{$documentRequest->id}}"> Delete <span class="fa fa-trash"></span> </a>
                                    </td>
                                </tr>

                                <div class="modal modal-warning fade" id="delete{{$documentRequest->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Document Request</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to delete this Document Request?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('documentRequest.destroy',$documentRequest->id) }}" data-toggle="validator">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger"> Confirm </button>
                                            </form>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="RejectionReason{{$documentRequest->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Document Request Rejection Reason</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ $documentRequest->rejectionReason }}
                                        </div>
                                        <div class="modal-footer">    
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="TrakingNumber{{$documentRequest->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Document Request Response Traking Number</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ $documentRequest->traking_number }}
                                        </div>
                                        <div class="modal-footer">    
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

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
    $('#documentRequests').dataTable({searching: true, paging: false, info: true, pageLength: 50});
</script>
@endsection
