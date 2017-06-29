<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEvenement extends Model 
{

    protected $table = 'type_evenement';
    public $timestamps = false;
    protected $fillable = array('event');

    public function evenements()
    {
        return $this->belongsToMany(Evenement::class);
    }

}