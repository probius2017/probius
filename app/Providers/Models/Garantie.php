<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garantie extends Model 
{

    protected $table = 'garanties';
    public $timestamps = false;
    protected $fillable = array('reference');

    public function contratsV()
    {
        return $this->hasMany(ContratV::class);
    }

}