<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Follower extends Model
{
    public function getFollowingCount(Int $user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    public function getFollowerCount(Int $user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }
}
