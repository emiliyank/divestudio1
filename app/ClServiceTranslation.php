<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClServiceTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['service'];

    public function clService()
    {
        return $this->belongsTo(ClService::class, 'cl_service_id');
    }
}
