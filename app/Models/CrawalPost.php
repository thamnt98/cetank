<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawalPost extends Model
{
    protected $fillable = [
        'comment', 'title', 'title_link','comment_link'
    ];
}
