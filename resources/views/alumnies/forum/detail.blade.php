@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Forums
        <small>Detail</small>
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
        
            <div class="box box-success">
            
                <!-- /.box-header -->
                <div class="box-body">
                        
                    <div class="well" style="margin-bottom:20px;">
                        <h3 style="margin-top:-5px;">{{ $post->title}}</h3>
                        <small><strong>Written on</strong> {{ $post->created_at}} 
                            <strong>by</strong> 
                            <a href="{{ route('alumniInfo', $post->user_id)}}">
                                {{ $post->user->first_name}} &nbsp;{{ $post->user->middle_name}}&nbsp;{{ $post->user->last_name}}
                            </a>
                        </small>
                        <br/>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{ $post->body }}</h5>
                                <br/>
                                <h4>
                                    <span class="fa fa-comment"></span>{{count($post->comments)}}

                                    {{-- <a class="btn" href="#" onclick="addDiv()"><i class="fa fa-plus"></i> Add Comment</a> --}}
                                    <a href="#" data-toggle="modal" class="btn" data-target="#addCommentModal"> <i class="fa fa-plus"></i> Add Comment </a>

                                    <div class="modal fade" id="addCommentModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                {{-- <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete Alumni Detail</h4>
                                                </div> --}}
                                                <form role="form" id="createComment" method="POST" action="{{ route('comments.store') }}" data-toggle="validator">
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="Comment">Comment</label>
                                                            <textarea class="form-control textarea" placeholder="Comment" name="comment"
                                                                    style="width: 100%; height: 125px;"></textarea>
                                                        </div>
                                
                                                        <input type="hidden" name="post" value="{{$post->id}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Add Comment </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    @if(Auth::user()->id == $post->user_id)
                                        <a class="btn" href="{{ route('posts.edit',$post->id) }}">Edit<span class="fa fa-pencil"></span></a>
                                        <a class="btn" href="#" data-toggle="modal" data-target="#delete"> Delete <span class="fa fa-trash"></span> </a>

                                        <div class="modal modal-warning fade" id="delete">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete Post</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure? You want to delete this Post?
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('posts.destroy',$post->id) }}" data-toggle="validator">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger"> Confirm </button>
                                                    </form>
                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endif
                                </h4>
                            </div>
                        </div> 

                        <div id="content">
                        </div>

                        <!-- /.list comments in here -->
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Comments</h3>
                                    </div>

                                    @foreach ($post->comments as $comment)
                                        <div class="box-body chat" id="chat-box" style="margin-top:30px;margin-left:-50px;">
                                        <!-- chat item -->
                                        <div class="item">                        
                                            <p class="message">
                                                <a href="{{ route('alumniInfo',$post->user_id)}}" class="name">
                                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$comment->created_at}}</small>
                                                    {{$comment->user->first_name}}&nbsp;{{$comment->user->middle_name}}&nbsp;{{$comment->user->last_name}}
                                                </a>
                                                {{$comment->comment}}

                                                @if(Auth::user()->id == $comment->user_id)
                                                    <div style="margin-left:50px;">
                                                        <a href="#" onclick="editDiv()">Edit<i class="fa fa-pencil"></i> </a>
                                                        <a href="#" data-toggle="modal" data-target="#deleteComment"> Delete <span class="fa fa-trash"></span> </a>
                                                    
                                                        <div class="modal modal-warning fade" id="deleteComment">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Delete Comment</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure? You want to delete this Comment?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="POST" action="{{ route('comments.destroy',$comment->id) }}" data-toggle="validator">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger"> Confirm </button>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </div>
                                                    <div id="editContent" style="margin-left:50px;"></div>
                                                @endif
                                            </p>
                                            <script type="text/javascript">
                                                function editDiv() {
                                                    var div = document.createElement('div');

                                                    div.className = 'row';

                                                    div.innerHTML =
                                                        `<form role="form" id="editComment" method="POST" action="{{ route('comments.update',$comment->id) }}" data-toggle="validator">
                                                            {!! csrf_field() !!}
                                                            <div class="box-body">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="Comment">Comment</label>
                                                                        <textarea class="form-control textarea" placeholder="Comment" name="comment"
                                                                                style="width: 100%; height: 125px;">{{$comment->comment}}</textarea>
                                                                    </div>

                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    
                                                                    <div class="box-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <input type="button" class="btn" value="-" onclick="removeEdit(this)">`;

                                                    document.getElementById('editContent').appendChild(div);
                                                }

                                                function removeEdit(input) {
                                                    document.getElementById('editContent').removeChild(input.parentNode);
                                                }
                                            </script>
                                            
                                            <!-- /.attachment -->
                                        </div>
                                        <!-- /.item -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>    
                        </div>
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

<script type="text/javascript">

    function addDiv() {
        var div = document.createElement('div');

        div.className = 'row';

        div.innerHTML =
            `<form role="form" id="createComment" method="POST" action="{{ route('comments.store') }}" data-toggle="validator">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea class="form-control textarea" placeholder="Comment" name="comment"
                                    style="width: 100%; height: 125px;"></textarea>
                        </div>

                        <input type="hidden" name="post" value="{{$post->id}}">
                        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                    </div>
                </div>
            </form>
            <input type="button" class="btn" value="-" onclick="removeRow(this)">`;

        document.getElementById('content').appendChild(div);
    }

    function removeRow(input) {
        document.getElementById('content').removeChild(input.parentNode);
    }
</script>


@endsection
