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
        Auth::user()->posts()->save($post);
        return redirect()->back();
    }

    public function show(Post $post) {
        return view('posts.show')->with('post', $post);
    }

    public function edit(Post $post) {
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, Post $post) {
        $this->validate($request, [
            'body' => 'required|max:255'
        ]);
        $post->body = $request->body;
        $post->save();
        return redirect(url('/posts', $post));
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect('/home');
    }
}
