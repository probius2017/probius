<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratV extends Model 
{

    protected $table = 'contrat_v';
    public $timestamps = true;
    protected $fillable = array('numero_contratV');

    public function vehicule()
    {
        return $this->hasOne(Vehicule::class);
    }

    public function sinistres()
    {
        return $this->hasMany(Sinistre::class);
    }

    public function garantie()
    {
        return $this->belongsTo(Garantie::class);
    }

}