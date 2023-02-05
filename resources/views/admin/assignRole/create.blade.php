@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Assign Role
        <small>Create</small>
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
                        <h3 class="box-title">Assign New Role to User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="createUserAccount" method="POST" action="{{ route('assignRole.store') }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">
                                {{-- roles --}}
                                <div class="form-group">
                                    <label for="Role"><strong>Roles: </strong></label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value=""> -- Select Role to Assign -- </option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"> {{$role->role}} </option>
                                        @endforeach
                                    </select>   
                                </div>

                                <div id="display"> </div>

                                <script type="text/javascript" id="myHtml">
                                    function show_selected() 
                                    {
                                        var d = document.getElementById('role');
                                        var selectedValue = d.options[d.selectedIndex].value
        
                                        if (selectedValue == "{{$departmentHeadRole->id}}") 
                                        {
                                            document.getElementById('display').innerHTML = `
                                                <div class="form-group">
                                                    <label for="Department"><strong>Department: </strong></label>
                                                    <select class="form-control" name="department" required>
                                                        <option value=""> -- Select Department -- </option>
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}"> {{$department->name}} </option>
                                                        @endforeach
                                                    </select>   
                                                </div>
                                            `;
                                        }

                                        else { document.getElementById('display').innerHTML = "" }

                                    }
                                    document.getElementById('role').addEventListener('click', show_selected)
                                </script>
    
                                <input type="hidden" name="user" value="{{$user->id}}">
                            </div>
                        </div>
                        <!-- /.box-body -->
        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
