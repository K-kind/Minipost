<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;
use Auth; // 追記

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
             ->only(['store', 'destroy']);
    }

    public function index(User $user, $type, Follower $follower)
    {
        if ($type === 'followings') {
            $users = $user->follows()->paginate(3);
        } else {
            $users = $user->followers()->paginate(3);
        }
        $following_count = $follower->getFollowingCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        return view('follow.index',[
            'user' => $user,
            'users' => $users,
            'type' => $type,
            'following_count'   => $following_count,
            'follower_count' => $follower_count,
        ]);
    }

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
