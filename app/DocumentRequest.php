<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    
    public function alumni()
    {
        return $this->belongsTo('App\Alumni');
    }
}
