<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
// use App\Http\Requests\PostRequest;

class UsersController extends Controller
{
    public function show(User $user) { // implicit binding
        return view('users.show')->with('user', $user);
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
