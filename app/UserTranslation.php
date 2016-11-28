<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'org_name', 'address', 'description'];

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
