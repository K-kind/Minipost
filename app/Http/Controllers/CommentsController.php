<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function store(Post $post, Request $request) {
        $this->validate($request, [
            'body' => 'required|max:255'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->body = $request->body;
        $post->comments()->save($comment);
        return redirect()->back();
    }

    // public function destroy(Post $post) {
    //     $comment = $post->comments->where('user_id', Auth::id())->first();
    //     $comment->delete();
    //     return redirect()->back();
    // }
}
