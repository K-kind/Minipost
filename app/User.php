<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    // public function isFollowing(?Int $user_id)
    // {
    //     if (!$user_id) {
    //         return false;
    //     }

    //     return $this->follows()->where('followed_id', $user_id)->exists();
    // }

    // フォローされているか
    public function isFollowed(?Int $user_id)
    {
        if (!$user_id) {
            return false;
        }

        return $this->followers()->where('following_id', $user_id)->exists();
    }

    public function deleteImage()
    {
        if ($this->image_filename) {
            Storage::delete('public/profile_images/'.$this->image_filename);
        }
    }
}
