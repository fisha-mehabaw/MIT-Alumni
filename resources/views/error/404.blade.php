@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          404 Error Page
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">404 error</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
    
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
    
              <p>
                We could not find the page you were looking for.
              </p>    
              
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>

@endsection
