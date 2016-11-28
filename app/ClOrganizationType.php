<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClOrganizationType extends Model
{
    use Translatable;
	public $translatedAttributes = ['organization_type'];
}
