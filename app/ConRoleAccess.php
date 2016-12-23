<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConRoleAccess extends Model
{
    protected $fillable = ['cl_role_id','cl_access_id'];

    public function clRoles(){
        return $this->belongsTo(ClRole::class, 'cl_role_id', 'code');
    }

    public function clAccesses(){
        return $this->belongsTo(ClAccess::class, 'cl_access_id');
    }
}

