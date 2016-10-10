<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserRegion extends Model
{
    protected $fillable = ['user_id','cl_region_id'];
    protected $user_id;
}


