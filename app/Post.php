<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // 追記

class Post extends Model
{
    protected $fillable = ['body'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function deleteImage()
    {
        if ($this->image_filename) {
            Storage::delete('public/post_images/'.$this->image_filename);
        }
    }
}
