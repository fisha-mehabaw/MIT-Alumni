@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Alumnies
        <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('alumnies.index') }}">Alumnies</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Alumnies Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active-tab1" style="border:1px solid #ccc" id="tab_personal_details" data-toggle="tab" href="#nav-personal_details" role="tab" aria-controls="nav-personal_details" aria-selected="true">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active-tab1 me" style="border:1px solid #ccc" id="tab_address_details" data-toggle="tab" href="#nav-address_details" role="tab" aria-controls="nav-address_details" aria-selected="false">Current Address</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active-tab1 me" style="border:1px solid #ccc" id="tab_employeement_details" role="tab" data-toggle="tab" href="#nav-employeement_details" aria-controls="nav-employeement_details" aria-selected="false">Employment Details</a>
                        </li>   
                                    
                        <li class="nav-item">
                            <a class="nav-link active-tab1 me" style="border:1px solid #ccc" id="tab_privatecompany_details" role="tab" data-toggle="tab" href="#nav-privatecompany_details" aria-controls="nav-privatecompany_details" aria-selected="false">Private Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active-tab1 me" style="border:1px solid #ccc" id="tab_pgstudy_details" role="tab" data-toggle="tab" href="#nav-pgstudy_details" aria-controls="nav-pgstudy_details" aria-selected="false">PG_Study</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active-tab1 me" style="border:1px solid #ccc" id="tab_certificate_details" role="tab" data-toggle="tab" href="#nav-certificate_details" aria-controls="nav-certificate_details" aria-selected="false">Cerificates</a>
                        </li>
                            
                    </ul>
                    <div class="tab-content" style="margin-top:5px;">
                        <div class="tab-pane active" id="nav-personal_details" role="tabpanel" aria-labelledby="nav-personal_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Personal Details</div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Almuni ID(Student ID):</label> 
                                            {{ $alumni->aid }}
                                        </div>
                                        <div class="form-group">
                                            <label>First Name:</label> 
                                            {{ $alumni->first_name }}
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name:</label> 
                                            {{ $alumni->middle_name }}
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name:</label> 
                                            {{ $alumni->last_name }}
                                        </div>
                                        <div class="form-group">
                                            <label>Birth Date:</label> 
                                            {{ $alumni->dob }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender:</label>
                                            {{ $alumni->gender }}                                        </div>
                                        <div class="form-group">
                                            <label>Marital Status:</label>
                                            {{ $alumni->marital_status }}
                                        </div>
                                        <div class="form-group">
                                            <label>BSc. Department:</label>
                                            {{ $alumni->department->name }}
                                        </div>
                                        <div class="form-group">
                                            <label>Year of Enrollment(E.C):</label>
                                            {{ $alumni->year_of_enrollment }}
                                        </div>
                                        <div class="form-group">
                                            <label>BSc. Year of Graduation(E.C):</label>
                                            {{ $alumni->year_of_graduation }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--End Personal Detail-->
                    
                        <div class="tab-pane fade" id="nav-address_details" role="tabpanel" aria-labelledby="nav-address_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Address Details</div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country:</label> 
                                            {{ $alumni->address->country }}
                                        </div>
                                        <div class="form-group">
                                            <label>State:</label> 
                                            {{ $alumni->address->state }}
                                        </div>
                                        <div class="form-group">
                                            <label>Office Phone:</label> 
                                            {{ $alumni->address->office_phone }}
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Phone #1:</label> 
                                            {{ $alumni->address->phone1 }}
                                        </div>
                                    </div>
        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Phone #2:</label> 
                                            {{ $alumni->address->phone2 }}
                                        </div>
                                        <div class="form-group">
                                            <label>Email:</label> 
                                            {{ $alumni->address->email }}
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook:</label> 
                                            {{ $alumni->address->facebook }}
                                        </div>
                                        <div class="form-group">
                                            <label>LinkedIn:</label> 
                                            {{ $alumni->address->linkedin }}
                                        </div>
                                        
                                    </div>                        
                                </div>
                            </div>
                        </div><!-- End Address Detail-->
        
                        <div class="tab-pane fade" id="nav-employeement_details" role="tabpanel" aria-labelledby="nav-employeement_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Employment Details</div>
                                @foreach ($alumni->employments as $employment)
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employer:</label> 
                                                {{ $employment->employer }}
                                            </div>
                                            <div class="form-group">
                                                <label>Address:</label> 
                                                {{ $employment->employer_address }}
                                            </div>
                                            <div class="form-group">
                                                <label>Employer Category:</label> 
                                                {{ $employment->employer_category }}
                                            </div>
                                            <div class="form-group">
                                                <label>Position Title:</label> 
                                                {{ $employment->position }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary:</label> 
                                                {{ $employment->salary }}
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Date:</label>
                                                {{ $employment->employment_date }}
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Type:</label> 
                                                {{ $employment->employment_type }}
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Info obtained through:</label>
                                                {{ $employment->employment_info }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End Employeement Detail-->
        
                        <div class="tab-pane fade" id="nav-privatecompany_details" role="tabpanel" aria-labelledby="nav-privatecompany_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Private Company Details</div>
                                @foreach ($alumni->privateCompanies as $privateCompanie)
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name:</label> 
                                                {{ $privateCompanie->company_name }}
                                            </div>
                                            <div class="form-group">
                                                <label>Company Address:</label> 
                                                {{ $privateCompanie->company_address }}
                                            </div>
                                            <div class="form-group">
                                                <label>Company Category:</label> 
                                                {{ $privateCompanie->company_category }}
                                            </div>                                
                                        </div>
                                        <div class="col-md-6">                                
                                            <div class="form-group">
                                                <label>Establishment Date:</label>
                                                {{ $privateCompanie->establishment_date}}
                                            </div>
                                            <div class="form-group">
                                                <label>Website (URL):</label> 
                                                {{ $privateCompanie->website_url}}
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End Private company Detail-->
        
                        <div class="tab-pane fade" id="nav-pgstudy_details" role="tabpanel" aria-labelledby="nav-pgstudy_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Post Graduate Study Details</div>
                                @foreach ($alumni->pgStudies as $pgStudie)
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name of Degree:</label> 
                                                {{ $pgStudie->degree }}
                                            </div>
                                            <div class="form-group">
                                                <label>Specialization:</label> 
                                                {{ $pgStudie->specialization }}
                                            </div>
                                            <div class="form-group">
                                                <label>Granting Organization:</label> 
                                                {{ $pgStudie->granting_organization }}
                                            </div>
                                            <div class="form-group">
                                                <label>Country:</label> 
                                                {{ $pgStudie->address }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>University:</label> 
                                                {{ $pgStudie->university }}
                                            </div>
                                            <div class="form-group">
                                                <label>Enrollment Year:</label>
                                                {{ $pgStudie->enrolment_year }}
                                            </div>
                                            <div class="form-group">
                                                <label>MSc Graduation Year:</label>
                                                {{ $pgStudie->graduation_year }}
                                            </div>
                                            <div class="form-group">
                                                <label>Specific Goals Achieved:</label>
                                                {{ $pgStudie->goals_achieved }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End PG_Study Detail-->
        
                        <div class="tab-pane fade" id="nav-certificate_details" role="tabpanel" aria-labelledby="nav-certificate_details-tab">
                            <div class="panel panel-info">
                                <div class="panel-heading">Certification Details</div>
                                @foreach ($alumni->certificates as $certificate)
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Certificate Name:</label> 
                                                {{ $certificate->certificate_name }}
                                            </div>
                                            <div class="form-group">
                                                <label>Certificate Provider Name:</label> 
                                                {{ $certificate->provider_name }}
                                            </div>
                                            <div class="form-group">
                                                <label>Certificate Provider Address:</label> 
                                                {{ $certificate->provider_address }}
                                            </div>                                
                                        </div>
                                        <div class="col-md-6">                                
                                            <div class="form-group">
                                                <label>Duration:</label> 
                                                {{ $certificate->duration }}
                                            </div>    
                                            <div class="form-group">
                                                <label>Skills obtained:</label> 
                                                {{ $certificate->skills }}
                                            </div>
                                            <div class="form-group">
                                                <label>Certification Date:</label>
                                                {{ $certificate->certification_date }}
                                            </div>                                                                
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End Certificate Detail-->
        
                    </div>
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
