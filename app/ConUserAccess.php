<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserAccess extends Model
{
    protected $fillable = ['user_id','cl_access_id'];

    public function clAccesses(){
        return $this->belongsTo(ClAccess::class, 'cl_access_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}