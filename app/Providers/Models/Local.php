<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Local extends Model 
{

    protected $table = 'locaux';
    public $timestamps = true;
    protected $fillable = array('cp_local', 'ville_local', 'adresse_local', 'apptEscalier', 'complementGeographique', 'superficie', 'ERP', 'precaire', 'etat_ini', 'nom_bailleur', 'info_bailleur', 'loyer', 'detail_loyer', 'prix_m2', 'pret', 'local_partage', 'precision_partage', 'accessibilite', 'observation_generale', 'charge_bailleur', 'charge_rdc', 'detail_charge', 'RI');

    //protected $hidden = array('ad_id', 'historique_id');

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function structures()
    {
        return $this->belongsToMany(Structure::class);
    }

    public function historiqueL()
    {
        return $this->belongsTo(HistoriqueLocal::class);
    }

    public function bail()
    {
        return $this->belongsTo(Bail::class);
    }

    public function isStruc($strucId)
    {
      
      foreach($this->structures as $structure)
      {
          
        if(count($this->structures) > 0){
          
          foreach ($this->structures as $structure) {
          
            if($structure->id == $strucId) return true;
          }
        } 

        return false;
        
      }
    
    }

    public function scopeLocauxStructures($query)
    {
        return $query
            ->join('local_structure', 'locaux.id', '=', 'local_structure.local_id')
            ->join('structures', 'structures.id', '=', 'local_structure.structure_id')
            ->join('baux', 'baux.id', '=', 'locaux.bail_id')
            ->join('assodep', 'assodep.id', '=', 'locaux.ad_id')
            ->orderBy('ville_local', 'ASC');
    }

}