<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Auth;

class LikesController extends Controller
{
    public function store(Post $post) {
        $like = new Like();
        $like->user_id = Auth::id();
        $post->likes()->save($like);
        return redirect()->back();
    }

    public function destroy(Post $post) {
        $like = $post->likes->where('user_id', Auth::id())->first();
        $like->delete();
        return redirect()->back();
    }
}
