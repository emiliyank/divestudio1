<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmStaticPageTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['topic','content'];

    public function cmStaticPage()
    {
        return $this->belongsTo(CmStaticPage::class, 'cm_static_page_id');
    }
}
