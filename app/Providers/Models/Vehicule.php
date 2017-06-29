<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model 
{

    protected $table = 'vehicules';
    public $timestamps = true;
    protected $fillable = array('immat', 'old_immat', 'pmc', 'atp');

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function contratV()
    {
        return $this->belongsTo(ContratV::class);
    }

    public function historique()
    {
        return $this->belongsTo(Historique::class);
    }

}