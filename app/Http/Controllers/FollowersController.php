<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth; // 追記

class FollowersController extends Controller
{
    public function store(User $user)
    {
        $current_user = Auth::user();
        // フォローしているか
        $is_following = $current_user->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $current_user->follow($user->id);
            return redirect()->back();
        }
    }

    public function destroy(User $user)
    {
        $current_user = Auth::user();
        // フォローしているか
        $is_following = $current_user->isFollowing($user->id);
        if($is_following) {
            // フォローしていなければフォローする
            $current_user->unfollow($user->id);
            return redirect()->back();
        }
    }
}
