<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body'];

    public function post() {
        return $this->belongsTo('App\User');
    }
}