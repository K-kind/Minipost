<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Follower;
use Auth;
// use App\Http\Requests\PostRequest;

class UsersController extends Controller
{
    public function show(User $user, Follower $follower) { // implicit binding
        $is_myself = Auth::id() === $user->id;
        $following_count = $follower->getFollowingCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        $is_followed = $user->isFollowed(Auth::id());
        return view('users.show', [
            'user'           => $user,
            'is_myself'      => $is_myself,
            // 'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            // 'timelines'      => $timelines,
            // 'tweet_count'    => $tweet_count,
            'following_count'   => $following_count,
            'follower_count' => $follower_count
        ]);
    }

    public function edit(User $user) { // implicit binding
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, User $user) {
    // public function update(PostRequest $request, Post $post) {
        $this->validate($request, [
            'name' => 'required|min:3|max:8',
            'email' => 'required|email',
            'introduction' => 'max:255'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        // // $user->password = $request->password;
        $user->introduction = $request->introduction;
        $user->save();
        return redirect(url('/users', $user));
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function destroy(User $user) {
        $user->delete();
        return redirect('/login');
    }
}
