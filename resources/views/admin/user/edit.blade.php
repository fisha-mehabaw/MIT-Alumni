@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Users Account
        <small>Edit</small>
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User Account:</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="editUserAccount" method="POST" action="{{ route('users.update',$user->id) }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name:</label> 
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{$user->first_name}}" id="firstName" required/>
                                    <span id="error_fname" class="text-danger"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Middle Name:</label> 
                                    <input type="text" class="form-control" name="middleName" placeholder="Middle Name" value="{{$user->middle_name}}" id="middleName"/>
                                    <span id="error_mname" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label>Last Name:</label> 
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="{{$user->last_name}}" id="lastName"/>
                                    <span id="error_lname" class="text-danger"></span>
                                </div>

                                {{-- user Email --}}
                                <div class="form-group">
                                    <label for="userEmail">Email Address:</label>
                                    <input type="email" class="form-control" name="email" id="userEmail" value="{{$user->email}}">
                                </div>
    
                                {{-- user password --}}
                                <div class="form-group">
                                    <label for="userPassword">Password:</label>
                                    <input type="password" class="form-control" name="password" id="userPassword" value="{{$user->password}}">
                                </div>
    
                                <input type="hidden" name="_method" value="PUT">
                            </div>
                        </div>
                        <!-- /.box-body -->
        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
                <!-- /.box -->
    
            </div>
                
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>

@endsection
