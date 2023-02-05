@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Departments
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('departments.index')}}">Departments</a></li>
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
                            <a class="btn btn-success" href="{{ route('departments.create') }}" > <i class="fa fa-plus"></i> Add Department</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">List of Departments</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="department" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Department Name</th>
                            <th> </th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(count($departments) > 0)
                            @php($count = 1)
                            @foreach ($departments as $department)
                                <tr>
                                    <td width=4%>{{ $count++ }}</td>
                                    <td>{{ $department->name}}</td>
                                    <td width=15%>
                                        <a href="{!! route('departments.edit',$department->id) !!}" class="" id ="">Edit <span class="fa fa-edit"></span></a>
                                        <a href="#" data-toggle="modal" data-target="#delete{{$department->id}}"> Delete <span class="fa fa-trash"></span> </a>
                                    </td>
                                </tr>

                                <div class="modal modal-warning fade" id="delete{{$department->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Department</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure? You want to Delete this Department?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('departments.destroy',$department->id) }}" data-toggle="validator">
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
    $('#department').dataTable({searching: true, paging: false, info: false, pageLength: 50});
</script>
@endsection
