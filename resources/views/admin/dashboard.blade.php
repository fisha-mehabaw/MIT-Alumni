@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dashboard
        <small>Index</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">

        @include('include.message')

        <!-- Small boxes (Stat box) -->
        <div class="row">

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>

@endsection
