<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Follower;
use App\Http\Requests\UserRequest;
use Auth;
// use App\Http\Requests\PostRequest;

class UsersController extends Controller
{
    public function show(User $user, Follower $follower) { // implicit binding
        $is_myself = Auth::id() === $user->id;
        $following_count = $follower->getFollowingCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        $is_followed = $user->isFollowed(Auth::id());
        $posts = $user->posts()->latest()->get();
        return view('users.show', [
            'user'           => $user,
            'is_myself'      => $is_myself,
            // 'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            // 'timelines'      => $timelines,
            // 'tweet_count'    => $tweet_count,
            'following_count'   => $following_count,
            'follower_count' => $follower_count,
            'posts' => $posts
        ]);
    }

    public function edit(User $user) { // implicit binding
        return view('users.edit')->with('user', $user);
    }

    public function update(UserRequest $request, User $user) {
        $user->name = $request->name;
        $user->email = $request->email;
        // // $user->password = $request->password;
        $user->introduction = $request->introduction;
        if ($request->photo) {
            $user->deleteImage();
            // $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');
            $filename = $request->photo->store('public/profile_images');
            $user->image_filename = basename($filename);
        }
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
        $user->deleteImage();
        $user->delete();
        return redirect('/login');
    }
}
