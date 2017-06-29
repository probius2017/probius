<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model 
{

    protected $table = 'assodep';
    protected $fillable = array('ad_name', 'numero_ad');
    public $timestamps = false;

    public function An()
    {
        return $this->belongsTo(Antenne::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function locaux()
    {
        return $this->hasMany(Local::class);
    }

    public function algecos()
    {
        return $this->hasMany(Algeco::class);
    }
}