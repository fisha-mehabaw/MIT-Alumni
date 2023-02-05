@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Forums
        <small>Index</small>
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
            <div class="col-xs-12">
                <div class="text-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"> 
                            {{-- <a class="btn btn-success" href="{{ route('posts.create') }}" > <i class="fa fa-plus"></i> Add New Discussion</a> --}}
                            <a href="#" data-toggle="modal" class="btn btn-success" data-target="#addDescussionModal"> <i class="fa fa-plus"></i> Add New Discussion </a>
                        </li>

                        <div class="modal fade" id="addDescussionModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {{-- <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Delete Alumni Detail</h4>
                                    </div> --}}
                                    <form role="form" id="createPost" method="POST" action="{{ route('posts.store') }}" data-toggle="validator">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="Comment">Discussion Title</label>
                                                <input type="text" name="title" placeholder="Title of Discussion" class="form-control">
                                            </div>
            
                                            <div class="form-group">
                                                <label for="Comment">Discussion Body</label>
                                                <textarea class="form-control textarea" placeholder="Add the content for your Discussion here" name="body"
                                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Add Discussion </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    

        <div class="row">
            <div class="col-xs-12">
        
            <div class="box box-success">
                
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($posts) >0)
                        @foreach ($posts as $post)
                            <div class="well" style="margin-bottom:20px;">
                                <h3 style="margin-top:-5px;"><a href="{{ route('posts.show',$post->id)}}" class="text-warning">{{ $post->title}}</a></h3>
                                <small><strong>Written on</strong> {{ $post->created_at}} 
                                    <strong>by</strong> 
                                    <a href="{{ route('alumniInfo',$post->user_id)}}">
                                        {{ $post->user->first_name}} &nbsp;{{ $post->user->middle_name}}&nbsp;{{ $post->user->last_name}} 
                                    </a>
                                </small>
                                <br/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5>{{ str_limit($post->body, $limit = 250, $end = ' ...') }}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h4><span class="fa fa-comment"></span>{{count($post->comments)}}</h4>
                                    </div>
                                </div>                                
                                
                            </div>
                        @endforeach
                        {{ $posts->links()}}
                    @else
                        <p>no posts found  in the forum</p>
                    @endif
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
