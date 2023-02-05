@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Alumnies List
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('alumnies.list') }}">Alumnies List</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row" style="padding-bottom:10px;">
            <div class="col-xs-12">
                <form class="form-inline" role="form" method="POST" action="{{ route('advancedSearch') }}" data-toggle="validator">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <select class="form-control" name="gender">
                            <option value="">~Gender~</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="department">
                            <option value="">~Department~</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="address">
                            <option value="">~Address~</option>
                            <option value="Inside">Inside Country</option>
                            <option value="Outside">Outside Country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="workCatagory" id="workCatagory">
                            <option value="">~Work Catagory~</option>
                            <option value="Employed">Employed</option>
                            <option value="Private Owned">Private Owned</option>
                        </select>
                    </div>
                    <div class="form-group" id="display">

                    </div>
                    <div class="form-group">
                        <select class="form-control" name="PGStudy">
                            <option value="">~PG Study~</option>
                            <option value="MSc">MSc</option>
                            <option value="MRes">MRes</option>
                            <option value="MBA">MBA</option>
                            <option value="PHD">PHD</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>   
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
        
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">List of Alumnies</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="alumni" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alumni ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Graduation Year</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @if(count($alumnies) > 0)
                                    @php($count = 1)
                                    @foreach ($alumnies as $alumni)
                                        <tr>
                                            <td width=2%>{{ $count++ }}</td>
                                            <td>{{ $alumni->aid }}</td>
                                            <td>{{ $alumni->first_name}} &nbsp {{ $alumni->middle_name}} &nbsp {{ $alumni->last_name}}</td>
                                            <td>{{ $alumni->department->name }}</td>
                                            <td>{{ $alumni->year_of_graduation }}</td>
                                            <td width=10%>
                                                <a href="{!! route('alumnies.detail',$alumni->id) !!}" class="" id ="">View <span class="fa fa-link"></span></a>
                                            </td>
                                        </tr>
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
    $('#alumni').DataTable({searching: true, paging: true, info: true, pageLength: 50});
</script>

<script type="text/javascript" id="myHtml">
    function show_selected() 
    {
        var d = document.getElementById('workCatagory');
        var selectedValue = d.options[d.selectedIndex].value;

        if (selectedValue == "Employed")
        { 
            document.getElementById('display').innerHTML = `
                <div class="form-group">
                    <select class="form-control" name="employerCatagory">
                        <option value="">~Employer Catagory~</option>
                        <option value="Governmental">Governmental</option>
                        <option value="Non Governmental">Non Governmental</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control" name="employmentType">
                        <option value="">~Employment Type~</option>
                        <option value="Contract">Contract</option>
                        <option value="Permanent">Permanent</option>
                    </select>
                </div>
            `   
        }
        else {
            document.getElementById('display').innerHTML = ""   
        }
    }
    document.getElementById('workCatagory').addEventListener('click', show_selected)
</script>
@endsection
