<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Algeco extends Model 
{

    protected $table = 'algecos';
    public $timestamps = true;
    protected $fillable = array('type_algeco', 'adresse_algeco', 'apptEscalier', 'complementGeographique', 'ville_algeco', 'cp_algeco');

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function sinistres()
    {
        return $this->hasManyThrough('App\Models\Sinistre', 'App\Models\Contrat');
    }
    
    public function bail()
    {
        return $this->belongsTo(Bail::class);
    }


}