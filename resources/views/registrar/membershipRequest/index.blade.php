@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Membership Requests
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('membershipRequests.index') }}">Membership Request</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">List of Membership Requests</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="membershipRequest" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alumni ID</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Graduation Year</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($membershipRequests) > 0)
                            @php($count = 1)
                            @foreach ($membershipRequests as $membershipRequest)
                                <tr>
                                    <td width=2%>{{ $count++ }}</td>
                                    <td>{{ $membershipRequest->aid }}</td>
                                    <td>{{ $membershipRequest->first_name }} &nbsp; {{ $membershipRequest->middle_name }} &nbsp; {{ $membershipRequest->last_name }}</td>
                                    <td>{{ $membershipRequest->email }}</td>
                                    <td>{{ $membershipRequest->graduation_year }}</td>
                                    <td width=10%>
                                        <a href="#" data-toggle="modal" data-target="#approve{{$membershipRequest->id}}"> Approve <span class="fa fa-edit"></span> </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="approve{{$membershipRequest->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Allow Membership</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to approve this Membership Request?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('membershipRequests.approve') }}" data-toggle="validator">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$membershipRequest->id}}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success"> Confirm </button>
                                            </form>
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
    $('#membershipRequest').dataTable({searching: true, paging: true, info: true, pageLength: 50});
</script>
@endsection
