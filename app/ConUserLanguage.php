<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserLanguage extends Model
{
    protected $fillable = ['user_id','cl_language_id'];
    protected $user_id;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clLanguage(){
        return $this->belongsTo(ClLanguage::class, 'cl_language_id');
    }
}

