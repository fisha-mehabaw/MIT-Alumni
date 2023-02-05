<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MIT Alumni') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>MIT</b> Alumni
  </div>

  <div class="register-box-body">
    @include('include.message')

    <p class="login-box-msg">Register a new membership</p>

    <form role="form" method="post" action="{{route('register.store')}}" id="createAlumni" data-toggle="validator">
        {!! csrf_field() !!}
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstName" placeholder="First name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="middleName" placeholder="Middle name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastName" placeholder="Last name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="retype_password" placeholder="Retype password" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="aid" placeholder="Student's ID" required>
            <span class="glyphicon glyphicon-id form-control-feedback"></span>
        </div>
    
        <div class="form-group has-feedback">
            <select class="form-control" name="department_id" id="department_id" required>
                <option selected disabled>~select Department~</option>
                <?php
                    foreach($departments as $department)
                    echo'<option value='.$department->id.'>'.$department->name.'</option>'
                ?>                                        
            </select>
        </div>

        <div class="form-group has-feedback">
            <select class="form-control" name="graduation_year" id="bscgraduationyear" required>
                <option selected disabled>~select Graduation Year~</option>
                <?php
                    $y = 1999; 
                    for($i=0;$i<date('Y');$i++)
                    echo'<option>'.($y+$i).'</option>'
                ?>                                        
            </select>
        </div>
      
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div style="padding-top:20px;">
        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
