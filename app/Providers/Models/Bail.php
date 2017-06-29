<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bail extends Model
{
    protected $table = 'baux';
    public $timestamps = true;
    protected $fillable = array('type_document', 'date_debut', 'date_fin', 'date_signature', 'duree_ini', 'tacite_reconduction', 'reconduction_description', 'clause', 'description_clause', 'quantite_site');
    protected $dates = ['created_at', 'updated_at', 'date_debut', 'date_signature', 'date_fin'];

    public function algecos()
    {
        return $this->hasMany(Algeco::class);
    }

    public function locaux()
    {
        return $this->hasMany(Local::class);
    }

    public function logements()
    {
        return $this->hasMany(Logement::class);
    }
}
