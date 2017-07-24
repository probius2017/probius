<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueLocal extends Model 
{

    protected $table = 'historiqueLocaux';
    public $timestamps = true;
    protected $fillable = array('ville_local', 'cp_local', 'adresse_local', 'apptEscalier', 'complementGeographique', 'superficie', 'ERP', 'contenu', 'structure', 'motif', 'date_fin', 'date_resiliation');

    public function locaux()
    {
        return $this->hasMany(Local::class);
    }
}