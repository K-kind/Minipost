<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required|max:255'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        // Auth::user()->posts()->save($post);
        $post->save();
        return redirect()->back();
    }
}
