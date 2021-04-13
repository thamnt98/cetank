<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'image'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }

    public function updateplan()
    {
        return $this->belongsTo(Plan::class,'up_plan_id');
    }

    public function referralUser()
    {
        return $this->belongsTo(User::class,'ref_user_id');
    }


}
