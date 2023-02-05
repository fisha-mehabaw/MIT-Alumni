@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Document Requests
        <small>Create</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('documentRequest.index') }}">Document Request</a></li>
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
                        <h3 class="box-title">Add New Document Request</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="requestDocument" method="POST" action="{{ route('documentRequest.store') }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">
                                {{-- Program--}}
                                <div class="form-group">
                                    <label for="role">Programme</label>
                                    <select class="form-control" name="program" required>
                                        <option value="">~Select Prgram type~</option>
                                        <option value="Diploma">Diploam</option>
                                        <option value="1st Degree">1st Degree</option>
                                        <option value="Postgraduate Degree">Postgraduate Degree</option>
                                        <option value="Certificate">Certificate</option>
                                    </select>
                                </div>

                                {{-- Request Type --}}
                                <div class="form-group">
                                    <label for="role">Document Request Type:</label>
                                    <select class="form-control" name="type" required>
                                        <option value="">~Select Document Request type~</option>
                                        <option value="Official">Official</option>
                                        <option value="Students Copy">Students Copy</option>
                                        <option value="True Copy">True Copy</option>
                                        <option value="Temporary Degree">Temporary Degree</option>
                                        <option value="Original Degree">Original Degree</option>
                                        <option value="Recommendation">Recommendation</option>
                                        <option value="Language Proficient">Language Proficient</option>
                                    </select>
                                </div>
                                <br>

                                <h5>If official, write the address to which transcript should be sent, bellow:</h5>
                                <div class="form-group">
                                    <label for="addressName">Name of Institute/University/organization</label>
                                    <input type="text" name="address_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="POBox">P.o.Box</label>
                                    <input type="text" name="address_pobox" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="Town">Town</label>
                                    <input type="text" name="address_town" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="Region">Region/State</label>
                                    <input type="text" name="address_region" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="Country">Country</label>
                                    <input type="text" name="address_country" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" required>
                                    <label for="verification">I approve that the content i fill is correct
                                </div>
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
