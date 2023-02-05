<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function create()
    {
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment'  => 'required|string',
            'post' => 'required|integer'
        ]);

        $input = $request->all();

        // check if the comment already exists
        // $checkIfExist = Comment::where('comment', '=', $input['comment'])
        //                         ->where('post_id', '=', $input['post'])
        //                         ->where('user_id', '=', auth()->user()->id)->get();

        // if (count($checkIfExist) > 0)
        // {
        //     return redirect()->route('comments.create')->with('error', 'Comment already Exist.');
        // }

        $comment = new Comment;

        $comment->comment   = $input['comment'];
        $comment->post_id  = $input['post'];
        $comment->user_id = auth()->user()->id;
        
        if ($comment->save())
        {
            return redirect()->back()->with('success', 'Comment Commented Successfully.');
        }

        return redirect()->back()->with('error', 'Comment Add Failed.');
    }

    public function show($id)
    {
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function edit($id)
    {
        return redirect()->back()->with('error', 'Access denied.');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comment'  => 'required|string',
        ]);

        $input = $request->all();
        $comment = Comment::findOrFail($id);

        // check if the user updating is the creater of the Comment
        if(auth()->user()->id != $comment->user_id)
        {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // check if the comment already exists
        // $checkIfExist = Comment::where('id', '!=', $id)
        //                         ->where('comment', '=', $input['comment'])
        //                         ->where('post_id', '=', $comment->post_id)
        //                         ->where('user_id', '=', auth()->user()->id)->get();

        // if (count($checkIfExist) > 0)
        // {
        //     return redirect()->route('comments.create')->with('error', 'Comment already Exist.');
        // }

        $comment->comment   = $input['comment'];
        
        if ($comment->save())
        {
            return redirect()->back()->with('success', 'Comment Update Successfully.');
        }

        return redirect()->back()->with('error', 'Comment Update Failed.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // check if the user deleting is the creater of the post
        if(auth()->user()->id != $comment->user_id)
        {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        if (Comment::destroy($id))
        {
            return redirect()->back()->with('success', 'Comment Deleted Successfully.');
        }

        return redirect()->back()->with('error', 'Comment Delete Failed.');
    }
}
