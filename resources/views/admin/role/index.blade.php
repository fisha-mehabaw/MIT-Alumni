@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Roles
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('roles.index')}}">Roles</a></li>
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
                            <a class="btn btn-success" href="{{ route('roles.create') }}" > <i class="fa fa-plus"></i> Add Role</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">List of Roles</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="role" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th> </th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($roles) > 0)
                            @php($count = 1)
                            @foreach ($roles as $role)
                                <tr>
                                    <td width=4%>{{ $count++ }}</td>
                                    <td>{{ $role->role}}</td>
                                    <td width=15%>
                                        <a href="{!! route('roles.edit',$role->id) !!}" class="" id =""><span class="fa fa-edit"></span></a>
                                        <a href="#" data-toggle="modal" data-target="#delete{{$role->id}}"><span class="fa fa-trash"></span> </a>
                                    </td>
                                </tr>

                                <div class="modal modal-warning fade" id="delete{{$role->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Role</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to Delete this Role?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('roles.destroy',$role->id) }}" data-toggle="validator">
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
    $('#role').dataTable({searching: true, paging: false, info: false, pageLength: 50});
</script>
@endsection
