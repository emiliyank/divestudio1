<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClOrganizationTypeTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['organization_type'];

    public function clOrganizationType()
    {
        return $this->belongsTo(ClOrganizationType::class, 'cl_organization_type_id');
    }
}
