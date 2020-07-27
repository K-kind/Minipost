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
}
