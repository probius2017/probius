<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model 
{

    protected $table = 'evenements';
    public $timestamps = true;
    protected $fillable = array('statut_event', 'nom_salle', 'nom_event', 'date_demande', 'date_reponse', 'remarque');

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function typeEvenements()
    {
        return $this->belongsToMany(TypeEvenement::class);
    }

}