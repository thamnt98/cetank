<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
