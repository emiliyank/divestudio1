<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserRegion extends Model
{
    protected $fillable = ['user_id','cl_region_id'];
    protected $user_id;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clRegion(){
        return $this->belongsTo(ClRegion::class, 'cl_region_id');
    }
}


