<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClRole extends Model
{
	use Translatable;
	public $translatedAttributes = ['role'];

	public $translationForeignKey = 'cl_role_id';

	public function Users(){
        return $this->hasMany(User::class, 'id', 'user_type');
    }

    public function conRoleAccesses()
    {
    	return $this->hasMany(ConRoleAccess::class, 'id');
    }
}

