<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CmMessage extends Model
{
    protected $fillable = ['message', 'to_user_id', 'date_read'];
    
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function toUser(){
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
