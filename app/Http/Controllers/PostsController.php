<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // 追記
use Auth; // 追記
class PostsController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required|max:255'
        ]);
        $post = new Post();
        $post->body = $request->body;
        $post->user_id = Auth::id();
        // Auth::user()->posts()->save($post);
        $post->save();
        return redirect()->back();
    }
}
