@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Change Password
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('user.changePassword')}}">Change Password</a></li>
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
                        <h3 class="box-title">Change Password</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="changePassword" method="POST" action="{{ route('changePassword.store') }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">
                                {{-- old Password --}}
                                <div class="form-group">
                                    <label class="control-label" for="old_password"><strong>Old Password:</strong></label>
                                    <div class="controls form-group">
                                        <input type="password" class="form-control" name="old_password" id="old_password" value="" />
                                        {{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
                                    </div>
                                </div>

                                {{-- new Password --}}
                                <div class="form-group">
                                    <label class="control-label" for="password"><strong>New Password:</strong></label>
                                    <div class="controls form-group">
                                        <input type="password" class="form-control" name="password" id="password" value="" />
                                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                                    </div>
                                </div>

                                {{-- confirm new Password --}}
                                <div class="form-group">
                                    <label class="control-label" for="password_confirm"><strong>Confirm New Password:</strong></label>
                                    <div class="controls form-group">
                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
                                        {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        <!-- /.box-body -->
        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Change</button>
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
