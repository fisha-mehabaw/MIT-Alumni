<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    
    public function alumni()
    {
        return $this->belongsTo('App\Alumni');
    }
}
