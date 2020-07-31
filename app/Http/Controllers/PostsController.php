<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // 追記
use Auth; // 追記
use App\Http\Requests\PostRequest; // 追記

class PostsController extends Controller
{
    public function store(PostRequest $request) {
        // $this->validate($request, [
        //     'body' => 'required|max:255'
        // ]);
        $post = new Post();
        $post->body = $request->body;
        if ($request->photo) {
            $filename = $request->photo->store('public/post_images');
            $post->image_filename = basename($filename);
        }
        Auth::user()->posts()->save($post);
        return redirect()->back();
    }

    public function show(Post $post) {
        $comments = $post->comments;
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function edit(Post $post) {
        return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $request, Post $post) {
        $post->body = $request->body;
        if ($request->photo) {
            $post->deleteImage();
            $filename = $request->photo->store('public/post_images');
            $post->image_filename = basename($filename);
        }
        $post->save();
        return redirect(url('/posts', $post));
    }

    public function destroy(Post $post) {
        $post->deleteImage();
        $post->delete();
        return redirect('/home');
    }
}
