<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sinistre extends Model 
{

    protected $table = 'sinistres';
    public $timestamps = true;
    protected $fillable = array('ref_rdc', 'ref_macif', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'cp_sinistre', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture');

    public function contratV()
    {
        return $this->belongsTo(ContratV::class);
    }

    public function typeSinistre()
    {
        return $this->belongsTo(TypeSinistre::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

}