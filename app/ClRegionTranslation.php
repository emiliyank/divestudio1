<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClRegionTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['region'];

    public function clRegion()
    {
        return $this->belongsTo(ClRegion::class, 'cl_region_id');
    }
}
