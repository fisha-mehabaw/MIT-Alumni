<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->middleware('isIdNumber');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(15);

        return view('alumnies.forum.index')->with('posts', $posts);
    }

    public function create()
    {
        //return view('alumnies.forum.create');
        return redirect()->back()->with('error', 'access denied!!');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required|string',
            'body'  => 'required|string',
        ]);

        $input = $request->all();

        // check if the Post already exists
        $checkIfExist = Post::where('title', '=', $input['title'])->where('user_id', '=', auth()->user()->id)->get();

        if (count($checkIfExist) > 0)
        {
            return redirect()->route('posts.index')->with('error', 'Discussion Post already Exist.');
        }

        $post = new Post;

        $post->title   = $input['title'];
        $post->body  = $input['body'];
        $post->user_id = auth()->user()->id;
        
        if ($post->save())
        {
            return redirect()->route('posts.index')->with('success', 'Discussion Post Created Successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'Discussion Post Add Failed.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('alumnies.forum.detail')->with('post', $post);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        // check if the user updating is the creater of the post
        if(Auth::user()->id != $post->user_id)
        {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return view('alumnies.forum.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'  => 'required|string',
            'body'  => 'required|string',
        ]);

        $input = $request->all();

        $post = Post::findOrFail($id);
        // check if the user updating is the creater of the post
        if(Auth::user()->id != $post->user_id)
        {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // check if the Post already exists
        $checkIfExist = Post::where('id', '!=', $id)->where('title', '=', $input['title'])->where('user_id', '=', auth()->user()->id)->get();

        if (count($checkIfExist) > 0)
        {
            return redirect()->route('posts.edit', ['id'=>$id])->with('error', 'Discussion Post already Exist.');
        }

        $post->title   = $input['title'];
        $post->body  = $input['body'];
        $post->user_id = auth()->user()->id;

        if ($post->save())
        {
            return redirect()->route('posts.edit', ['id'=>$id])->with('success', 'Discussion Post Update Successfully.');
        }

        return redirect()->route('posts.edit', ['id'=>$id])->with('error', 'Discussion Post Update Failed.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // check if the user deleting is the creater of the post
        if(Auth::user()->id != $post->user_id)
        {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        if (Post::destroy($id))
        {
            return redirect()->route('posts.index')->with('success', 'Discussion Post Deleted Successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'Discussion Post Delete Failed.');
    }
}
