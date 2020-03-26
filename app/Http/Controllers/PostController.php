<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function posts() {
        $posts = Post::all();
        return view('posts/posts', compact('posts'));
    }


    public function LikePostRequest(Request $request) {
        $post = Post::find($request->id);
        $response = auth()->user()->toggleLike($post);


        return response()->json(['success'=>$response]);
    }
}
