<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConUserLanguage extends Model
{
    protected $fillable = ['user_id','cl_language_id'];
    protected $user_id;
}

