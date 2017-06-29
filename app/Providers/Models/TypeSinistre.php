<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeSinistre extends Model 
{

    protected $table = 'type_sinistre';
    public $timestamps = false;
    protected $fillable = array('reference');

    public function sinistres()
    {
        return $this->hasMany('Sinistre');
    }

}