@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Users Account
        <small>Detail</small>
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
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">User Account Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="department" class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width=20%> Full Name: </th>
                            <td> {{ $user->first_name}} &nbsp; {{ $user->middle_name}} &nbsp; {{ $user->last_name}}</td>
                        </tr>
                        <tr>
                            <th width=20%> Email Address: </th>
                            <td> {{ $user->email}}</td>
                        </tr>
                        <tr>
                            <th> Status: </th>
                            <td> @if($user->status == 1) Active @else Deactive @endif</td>
                        </tr>
                        <tr>
                            <th> Roles: </th>
                            <td> 
                                <table>
                                    @if(count($user->roles) >0)
                                        @foreach ($user->roles as $role)
                                        <tr>
                                            <td width=60%>{{ $role->role }} </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#remove{{$user->id}}{{$role->id}}">Remove Role <span class="fa fa-trash"></span></a>
                                            </td>
                                            
                                            <div class="modal modal-warning fade" id="remove{{$user->id}}{{$role->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Remove User Role</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure? You want to Remove this User Role?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('assignRole.remove', ['user_id'=>$user->id, 'role_id'=>$role->id]) }}" data-toggle="validator">
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
                                        </tr>
                
                                        @endforeach
                                        <tr>
                                            <td>
                                                <a href="{!! route('assignRole.assign', ['id'=>$user->id]) !!}">Assign Role <span class="fa fa-edit"></span></a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <a href="{!! route('assignRole.assign', ['id'=>$user->id]) !!}">Assign Role <span class="fa fa-edit"></span></a>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                                
                            </td>
                        </tr>
                        @foreach ($user->userRoles as $userRole)
                            @if($userRole->department_id != NULL)
                                <tr>
                                    <th> Department: </th>
                                    <td> 
                                        {{ $userRole->department->name}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        
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
@endsection
