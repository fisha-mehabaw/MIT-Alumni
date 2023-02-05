@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Alumnies Profile
        <small>create</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('alumniesProfile.index') }}">Alumnies Profile</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"> Alumnies Personal Profile</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="{{route('alumniesProfile.store')}}" id="createAlumni" data-toggle="validator">
                        {!! csrf_field() !!}
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active-tab1" style="border:1px solid #ccc" id="tab_personal_details">Personal Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive-tab1 me" style="border:1px solid #ccc" id="tab_address_details">Current Address</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link inactive-tab1 me" style="border:1px solid #ccc" id="tab_employeement_details">Employment Details</a>
                            </li>   
                                        
                            <li class="nav-item">
                                <a class="nav-link inactive-tab1 me" style="border:1px solid #ccc" id="tab_privatecompany_details">Private Company</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive-tab1 me" style="border:1px solid #ccc" id="tab_pgstudy_details">PG_Study</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inactive-tab1 me" style="border:1px solid #ccc" id="tab_certificate_details">Cerificates</a>
                            </li>
                                
                        </ul>
                        <div class="tab-content" style="margin-top:5px;">
                            <div class="tab-pane active" id="personal_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Personal Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Almuni ID(Student ID):</label> 
                                                <input type="text" class="form-control" name="aid" placeholder="Student's ID" id="aid" required/>
                                                <span id="error_aid" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>First Name:</label> 
                                                <input type="text" class="form-control" name="firstName" placeholder="First Name" id="firstName" required/>
                                                <span id="error_fname" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Middle Name:</label> 
                                                <input type="text" class="form-control" name="middleName" placeholder="Middle Name" id="middleName"/>
                                                <span id="error_mname" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name:</label> 
                                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" id="lastName"/>
                                                <span id="error_lname" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Birth Date:</label> 
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" name="dob" placeholder="Birth Date" id="dob" required>
                                                </div>
                                                <span id="error_dob" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender:</label>
                                                <select class="form-control" name="gender" id="gender" required>
                                                    <option selected disabled>~select Gender~</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <span id="error_gender" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Marital Status:</label>
                                                <select class="form-control" name="maritalStatus" id="maritalstatus" required>
                                                    <option selected disabled>~select Marital Status~</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                                <span id="error_maritalstatus" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>BSc. Department:</label>
                                                <select class="form-control" name="department" id="department" required>
                                                    <option selected disabled>~select BSc. Department~</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error_department" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Year of Enrollment(E.C):</label>
                                                <select class="form-control" name="enrollmentYear" id="enrollmentyear">
                                                    <option selected disabled>~select Enrollment Year~</option>
                                                    <?php
                                                        $y = 1995; 
                                                        $dif = date('Y') -4  - $y +1;
                                                        for($i=0;$i<$dif;$i++)
                                                        echo'<option>'.($y+$i).'</option>'
                                                    ?>
                                                </select>
                                                <span id="error_enrollmentyear" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>BSc. Year of Graduation(E.C):</label>
                                                <select class="form-control" name="graduationYear" id="bscgraduationyear">
                                                    <option selected disabled>~select BSc. Graduation Year~</option>
                                                    <?php
                                                        $y = 1999; 
                                                        $dif = date('Y') - $y +1;
                                                        for($i=0;$i<$dif;$i++)
                                                        echo'<option>'.($y+$i).'</option>'
                                                    ?>
                                                </select>
                                                <span id="error_bscgraduationyear" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <br/>
                                        <div align="right">
                                            <button type="button" name="btn_personal" id="btn_personal" class="btn btn-info btn-lg">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!--End Personal Detail-->

                            <div class="tab-pane fade" id="address_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Address Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country:</label> 
                                                <input type="text" class="form-control" name="country" placeholder="Living Country" id="country"/>
                                                <span id="error_country" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>State:</label> 
                                                <input type="text" class="form-control" name="state" placeholder="Enter Living State" id="state"/>
                                                <span id="error_state" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Office Phone:</label> 
                                                <input type="phone" class="form-control" name="officephone" placeholder="Office Phone" id="officephone"/>
                                                <span id="error_officephone" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Phone #1:</label> 
                                                <input type="phone" class="form-control" name="phone1" placeholder="Mobile Phone number" id="phone1"/>
                                                <span id="error_phone1" class="text-danger"></span>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Phone #2:</label> 
                                                <input type="phone" class="form-control" name="phone2" placeholder="Mobile Phone number" id="phone2"/>
                                                <span id="error_phone2" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email:</label> 
                                                <input type="email" class="form-control" name="email" placeholder="Email address" id="email"/>
                                                <span id="error_email" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Facebook:</label> 
                                                <input type="text" class="form-control" name="facebook" placeholder="Facebook address" id="facebook"/>
                                                <span id="error_facebook" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>LinkedIn:</label> 
                                                <input type="text" class="form-control" name="linkedin" placeholder="Linked Address" id="linkedin"/>
                                                <span id="error_linkedin" class="text-danger"></span>
                                            </div>
                                           
                                        </div>
                                        <br/>
                                        <div align="right">
                                            <button type="button" name="previous_btn_address" id="previous_btn_address" class="btn btn-default btn-lg">Previous</button>
                                            <button type="button" name="btn_address" id="btn_address" class="btn btn-info btn-lg">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Address Detail-->
            
                            <div class="tab-pane fade" id="employeement_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Employment Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employer:</label> 
                                                <input type="text" class="form-control" name="employer" placeholder="Employer Name" id="employer"/>
                                                <span id="error_employer" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Address:</label> 
                                                <input type="text" class="form-control" name="empaddress" placeholder="Enter address of employer" id="empaddress"/>
                                                <span id="error_empaddress" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Employer Category:</label> 
                                                <select name="empcategory" class="form-control" id="empcategory">
                                                    <option value="">~select Employer Catagory~</option>
                                                    <option value="Governmental">Governmental</option>
                                                    <option value="Non Governmental">Non Governmental</option>
                                                </select>
                                                <span id="error_empcategory" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Position Title:</label> 
                                                <input type="text" class="form-control" name="position" placeholder="Your Position" id="position"/>
                                                <span id="error_position" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary:</label> 
                                                <input type="text" class="form-control" name="salary" placeholder="Salary Range" id="salary"/>
                                                <span id="error_salary" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Date:</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" name="empdate" placeholder="Employment Date" id="empdate">
                                                </div>
                                                <span id="error_empdate" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Type:</label> 
                                                <select class="form-control" name="emptype" id="emptype">
                                                    <option value="">~Select Employment Type~</option>
                                                    <option value="Contract">Contract</option>
                                                    <option value="Permanent">Permanent</option>
                                                </select>
                                                <span id="error_emptype" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Employment Info obtained through:</label>
                                                <select class="form-control" name="empinfo" id="empinfo">
                                                    <option value="">~select Employment Info Obtained through~</option>
                                                    <option value="Job portal websites">Job portal websites</option>
                                                    <option value="Social media">Social media</option>
                                                    <option value="V/Radio advertisment">TV/Radio advertisment</option>
                                                    <option value="Recomendation">Recomendation</option>                                        
                                                </select>
                                                <span id="error_empinfo" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <br/>
                                        <div align="right">
                                            <button type="button" name="previous_btn_employeement" id="previous_btn_employeement" class="btn btn-default btn-lg">Previous</button>
                                            <button type="button" name="btn_employeement" id="btn_employeement" class="btn btn-info btn-lg">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Employeement Detail-->
            
                            <div class="tab-pane fade" id="privatecompany_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Private Company Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name:</label> 
                                                <input type="text" class="form-control" name="companyname" placeholder="Name of your company" id="companyname"/>
                                                <span id="error_companyname" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Address:</label> 
                                                <input type="text" class="form-control" name="companyaddress" placeholder="Ethiopia-Mekelle" id="companyaddress"/>
                                                <span id="error_companyaddress" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Category:</label> 
                                                <input type="text" class="form-control" name="companycategory" placeholder="Company Category" id="companycategory"/>
                                                <span id="error_companycategory" class="text-danger"></span>
                                            </div>                                
                                        </div>
                                        <div class="col-md-6">                                
                                            <div class="form-group">
                                                <label>Establishment Date:</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" name="establishmentdate" placeholder="Establishment Date" id="establishmentdate">
                                                </div>
                                                <span id="error_establishmentdate" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Website (URL):</label> 
                                                <input type="text" class="form-control" name="website" placeholder="Your company's website" id="website"/>
                                                <span id="error_website" class="text-danger"></span>
                                            </div>
                                           
                                        </div>
                                        <br/>
                                        <div align="right">
                                            <button type="button" name="previous_btn_privatecompany" id="previous_btn_privatecompany" class="btn btn-default btn-lg">Previous</button>
                                            <button type="button" name="btn_privatecompany" id="btn_privatecompany" class="btn btn-info btn-lg">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Private company Detail-->
            
                            <div class="tab-pane fade" id="pgstudy_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Post Graduate Study Details </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name of Postgraduate Study:</label> 
                                                <select class="form-control" name="degree[]" id="degree">
                                                    <option value="">~Select PG Study</option>
                                                    <option value="MSc">MSc</option>
                                                    <option value="MRes">MRes</option>
                                                    <option value="MBA">MBA</option>
                                                    <option value="PHD">PHD</option>
                                                </select>
                                                <span id="error_degree" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Specialization:</label> 
                                                <input type="text" class="form-control" name="specialization[]" placeholder="Specialization Area(Name)" id="empaddress"/>
                                                <span id="error_specialization" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Granting Organization:</label> 
                                                <input type="text" class="form-control" name="grant[]" placeholder="Scholarship Funding Organization" id="grant"/>
                                                <span id="error_grant" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Country:</label> 
                                                <input type="text" class="form-control" name="pgcountry[]" placeholder="Country of study" id="pgcountry"/>
                                                <span id="error_country" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>University:</label> 
                                                <input type="text" class="form-control" name="university[]" placeholder="University of study" id="university"/>
                                                <span id="error_university" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Enrollment Year:</label>
                                                <select class="form-control" name="enrollmentyear[]" id="enrollmentyear">
                                                    <option value="">~select PG Enrollment Year~</option>
                                                    <?php
                                                        $y = 1999; 
                                                        $dif = date('Y') -2  - $y +1;
                                                        for($i=0;$i<$dif;$i++)
                                                        echo'<option>'.($y+$i).'</option>'
                                                    ?>
                                                </select>
                                                <span id="error_enrollmentyear" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>MSc Graduation Year:</label>
                                                <select class="form-control" name="mscgraduationyear[]" id="mscgraduationyear">
                                                    <option value="">~select PG Graduation Year~</option>
                                                    <?php
                                                        $y = 1999;
                                                        $dif = date('Y') - $y +1;
                                                        for($i=0;$i<$dif;$i++)
                                                        echo'<option>'.($y+$i).'</option>'
                                                    ?>
                                                </select>
                                                <span id="error_mscgraduationyear" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Specific Goals Achieved:</label>
                                                <textarea class="form-control" name="goalsachieved[]" id="goalsachieved" placeholder="experience gained and goals achieved"></textarea>
                                                <span id="error_goalsachieved" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <br/>
                                        <br/>

                                        <div id="pgstudy_content" class="panel-body">
                                        </div>

                                        <div align="right">
                                            <a href="#" class="btn btn-success btn-lg" onclick="add_pgStudy()" align="right"><span class="fa fa-plus"></span> </a>
                                            <button type="button" name="previous_btn_pgstudy" id="previous_btn_pgstudy" class="btn btn-default btn-lg">Previous</button>
                                            <button type="button" name="btn_pgstudy" id="btn_pgstudy" class="btn btn-info btn-lg">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End PG_Study Detail-->
            
                            <div class="tab-pane fade" id="certificate_details">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Certification Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Certificate Name:</label> 
                                                <input type="text" class="form-control" name="certificatename[]" placeholder="Name of the certificate" id="certificatename"/>
                                                <span id="error_certificatename" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Certificate Provider Name:</label> 
                                                <input type="text" class="form-control" name="providername[]" placeholder="eg. CSCO" id="providername"/>
                                                <span id="error_providername" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Certificate Provider Address:</label> 
                                                <input type="text" class="form-control" name="provideraddress[]" placeholder="Ethiopia-Mekelle" id="provideraddress"/>
                                                <span id="error_provideraddress" class="text-danger"></span>
                                            </div>                                
                                        </div>
                                        <div class="col-md-6">                                
                                            <div class="form-group">
                                                <label>Duration:</label> 
                                                <input type="text" class="form-control" name="duration[]" placeholder="eg. 5 months" id="duration"/>
                                                <span id="error_duration" class="text-danger"></span>
                                            </div>    
                                            <div class="form-group">
                                                <label>Skills obtained:</label> 
                                                <textarea class="form-control" name="skills[]" placeholder="Specific skills obtained" id="skills"></textarea>
                                                <span id="error_skills" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Certification Date:</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" name="certificationdate[]" placeholder="Certification Date" id="certificationdate">
                                                </div>
                                                <span id="error_certificationdate" class="text-danger"></span>
                                            </div>                                                                
                                        </div>
                                        <br/>
                                        <br/>

                                        <div id="certificate_content" class="panel-body">
                                        </div>

                                        <div align="right">
                                            <a href="#" class="btn btn-success btn-lg" onclick="add_certificate()" align="right"><span class="fa fa-plus"></span> </a>
                                            <button type="button" name="previous_btn_certificate" id="previous_btn_certificate" class="btn btn-default btn-lg">Previous</button>
                                            <button type="submit" name="btn_certificate" id="btn_certificate" class="btn btn-success btn-lg">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Certificate Detail-->
            
                        </div>
                    </form>
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
    
    $('#dob').datepicker({
        autoclose: true
    })

    $('#empdate').datepicker({
        autoclose: true
    })

    $('#establishmentdate').datepicker({
        autoclose: true
    })

    $('#certificationdate').datepicker({
        autoclose: true
    })

</script>

<script type="text/javascript">

    function add_pgStudy() {
        var div = document.createElement('div');

        div.className = 'row';

        div.innerHTML = `
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name of Postgraduate Study:</label> 
                    <select class="form-control" name="degree[]" id="degree">
                        <option value="">~Select PG Study</option>
                        <option value="MSc">MSc</option>
                        <option value="MRes">MRes</option>
                        <option value="MBA">MBA</option>
                        <option value="PHD">PHD</option>
                    </select>
                    <span id="error_degree" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Specialization:</label> 
                    <input type="text" class="form-control" name="specialization[]" placeholder="Specialization Area(Name)" id="empaddress"/>
                    <span id="error_specialization" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Granting Organization:</label> 
                    <input type="text" class="form-control" name="grant[]" placeholder="Scholarship Funding Organization" id="grant"/>
                    <span id="error_grant" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Country:</label> 
                    <input type="text" class="form-control" name="pgcountry[]" placeholder="Country of study" id="pgcountry"/>
                    <span id="error_country" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>University:</label> 
                    <input type="text" class="form-control" name="university[]" placeholder="University of study" id="university"/>
                    <span id="error_university" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Enrollment Year:</label>
                    <select class="form-control" name="enrollmentyear[]" id="enrollmentyear">
                        <option value="">~select PG Enrollment Year~</option>
                        <?php
                            $y = 1999; 
                            $dif = date('Y') -2  - $y +1;
                            for($i=0;$i<$dif;$i++)
                            echo'<option>'.($y+$i).'</option>'
                        ?>
                    </select>
                    <span id="error_enrollmentyear" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>MSc Graduation Year:</label>
                    <select class="form-control" name="mscgraduationyear[]" id="mscgraduationyear">
                        <option value="">~select PG Graduation Year~</option>
                        <?php
                            $y = 1999; 
                            $dif = date('Y') - $y +1;
                            for($i=0;$i<$dif;$i++)
                            echo'<option>'.($y+$i).'</option>'
                        ?>
                    </select>
                    <span id="error_mscgraduationyear" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Specific Goals Achieved:</label>
                    <textarea class="form-control" name="goalsachieved[]" id="goalsachieved" placeholder="experience gained and goals achieved"></textarea>
                    <span id="error_goalsachieved" class="text-danger"></span>
                </div>
            </div>
            <br>
            <a href="#" class="btn btn-danger btn-sm remove" onclick="removePgstudyRow(this)"><span class="fa fa-trash"></span> </a> 
            <br/>
            <br/>
        `;

        document.getElementById('pgstudy_content').appendChild(div);
    }

    function removePgstudyRow(input) {
        document.getElementById('pgstudy_content').removeChild(input.parentNode);
    }

    function add_certificate() {
        var div = document.createElement('div');

        div.className = 'row';

        div.innerHTML = `
            <div class="col-md-6">
                <div class="form-group">
                    <label>Certificate Name:</label> 
                    <input type="text" class="form-control" name="certificatename[]" placeholder="Name of the certificate" id="certificatename"/>
                    <span id="error_certificatename" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Certificate Provider Name:</label> 
                    <input type="text" class="form-control" name="providername[]" placeholder="eg. CSCO" id="providername"/>
                    <span id="error_providername" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Certificate Provider Address:</label> 
                    <input type="text" class="form-control" name="provideraddress[]" placeholder="Ethiopia-Mekelle" id="provideraddress"/>
                    <span id="error_provideraddress" class="text-danger"></span>
                </div>                                
            </div>
            <div class="col-md-6">                                
                <div class="form-group">
                    <label>Duration:</label> 
                    <input type="text" class="form-control" name="duration[]" placeholder="eg. 5 months" id="duration"/>
                    <span id="error_duration" class="text-danger"></span>
                </div>    
                <div class="form-group">
                    <label>Skills obtained:</label> 
                    <textarea class="form-control" name="skills[]" placeholder="Specific skills obtained" id="skills"></textarea>
                    <span id="error_skills" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Certification Date:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="certificationdate[]" placeholder="Certification Date" id="certificationdate">
                    </div>
                    <span id="error_certificationdate" class="text-danger"></span>
                </div>                                                                
            </div>
            <br>
            <a href="#" class="btn btn-danger btn-sm remove" onclick="removeCertificateRow(this)"><span class="fa fa-trash"></span> </a> 
            <br/>
            <br/>
        `;

        document.getElementById('certificate_content').appendChild(div);
    }

    function removeCertificateRow(input) {
        document.getElementById('certificate_content').removeChild(input.parentNode);
    }
</script>
@endsection
