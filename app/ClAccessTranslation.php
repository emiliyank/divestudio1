<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClAccessTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['access'];

    public function clAccess()
    {
        return $this->belongsTo(ClAccess::class, 'cl_access_id');
    }
}
