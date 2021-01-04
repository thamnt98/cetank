<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $table = 'signals';

    protected $guarded = [''];

    public function comments()
    {
    	return $this->hasMany(Comment::class,'signal_id');
    }

    public function signalPlans()
    {
        return $this->hasMany(SignalPlan::class,'signal_id');
    }

    public function symbol()
    {
        return $this->belongsTo(Symbol::class,'symbol_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class,'asset_id');
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class,'frame_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function admin()
    {
        return Admin::first();
    }

}
