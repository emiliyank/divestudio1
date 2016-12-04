<?php

namespace App;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClFeedbackTopic extends Model{
    use Translatable;
    public $translatedAttributes = ['service'];
}
