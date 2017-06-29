<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model 
{

    protected $table = 'marques';
    public $timestamps = false;
    protected $fillable = array('name_marque');

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }

}