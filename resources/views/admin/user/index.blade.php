@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Users Account
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('users.index')}}">Users Account</a></li>
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
                            <a class="btn btn-success" href="{{ route('users.create') }}" > <i class="fa fa-plus"></i> Add User Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">List of User Accounts</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="user" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th> </th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($users) > 0)
                            @php($count = 1)
                            @foreach ($users as $user)
                                <tr>
                                    <td width=2%>{{ $count++ }}</td>
                                    <td>{{ $user->first_name}} &nbsp; {{ $user->middle_name}} &nbsp; {{ $user->last_name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>@if($user->status == 1) Active @else Deactive @endif</td>
                                    <td>
                                        <table>
                                            @if(count($user->roles) > 0)
                                                @foreach ($user->roles as $role)
                                                    <td>{{ $role->role }} &nbsp; &nbsp; </td>
                                                @endforeach
                                                <td>
                                                    <a href="{!! route('assignRole.assign',$user->id) !!}">Assign Role <span class="fa fa-edit"></span></a>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="{!! route('assignRole.assign',$user->id) !!}">Assign Role <span class="fa fa-edit"></span></a>
                                                </td>
                                            @endif
                                        </table>       
                                    </td>
                                    <td width=25%>
                                        <a href="{!! route('users.edit',$user->id) !!}" class="" id ="">Edit <span class="fa fa-edit"></span></a>
                                        <a href="{!! route('users.show',$user->id) !!}" class="" id ="">View <span class="fa fa-link"></span></a>
                                        @if(e($user->status) == 1)
                                            <a href="#" data-toggle="modal" data-target="#deactivate{{$user->id}}"> Deactivate <span class="fa fa-lock"></span> </a>
                                        @endif
                                        @if($user->status == 0)
                                            <a href="#" data-toggle="modal" data-target="#activate{{$user->id}}"> Activate <span class="fa fa-lock"></span> </a>
                                        @endif
                                        <a href="#" data-toggle="modal" data-target="#delete{{$user->id}}"> Delete <span class="fa fa-trash"></span> </a>
                                    </td>
                                </tr>

                                <div class="modal modal-warning fade" id="delete{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete User Account</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to Delete this User Account?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('users.destroy',$user->id) }}" data-toggle="validator">
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

                                <div class="modal modal-warning fade" id="deactivate{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Deactivate User Account</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to Deactivate this User Account?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('users.deactivate') }}" data-toggle="validator">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger"> Confirm </button>
                                            </form>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal modal-success fade" id="activate{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Activate User Account</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to Activate this User Account?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('users.activate') }}" data-toggle="validator">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger"> Confirm </button>
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
    $('#user').DataTable({searching: true, paging: true, info: true, pageLength: 50});
</script>
@endsection
