@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Alumni Reports
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('reports') }}">Alumni Reports</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title">Alumni Reports</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Number of Alumnie Inside Country</th>
                            <td width=70%>{{ $numbersInsideCountry}}</td>
                        </tr>

                        <tr>
                            <th>Number of Alumnie Outside Country</th>
                            <td>{{ $numbersOutsideCountry}}</td>
                        </tr>

                        <tr>
                            <th>Number of Alumnie Who are Employed</th>
                            <td>{{ $numbersEmployed }}</td>
                        </tr>

                        <tr>
                            <th>Number of Alumnie Who have Private Companys</th>
                            <td>{{ $numbersPrivateCompany }}</td>
                        </tr>

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
