@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Forums 
        <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('posts.index') }}">Forums</a></li>
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
                        <h3 class="box-title">Edit Post</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="editPost" method="POST" action="{{ route('posts.update',$post->id) }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="postTitle">Discussion Post Title</label>
                                    <input type="text" name="title" value="{{ $post->title}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="POBox">Discussion Post Body</label>
                                    <textarea class="form-control textarea" placeholder="Post Body" name="body"
                                            style="width: 100%; height: 125px;">{{ $post->body }}</textarea>
                                </div>

                                <input type="hidden" name="_method" value="PUT">

                            </div>
                        </div>
                        <!-- /.box-body -->
        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
