<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function destroy(Post $post, Comment $comment) {
        $comment->delete();
        return redirect()->back();
    }
}
