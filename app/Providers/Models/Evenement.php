<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model 
{

    protected $table = 'evenements';
    public $timestamps = true;
    protected $fillable = array('nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque');
    protected $dates = ['date_demande', 'date_reponse', 'created_at', 'updated_at'];

/*    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function sinistres()
    {
        return $this->hasManyThrough('App\Models\Sinistre', 'App\Models\Contrat');
    }*/
}