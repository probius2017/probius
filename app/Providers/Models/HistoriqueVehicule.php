<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueVehicule extends Model 
{

    protected $table = 'HistoriqueVehicules';
    public $timestamps = true;
    protected $fillable = array('ad', 'marque', 'model', 'immat', 'date_resiliation', 'motif');

    public function vehicules()
    {
        return $this->hasMany(Local::class);
    }
}