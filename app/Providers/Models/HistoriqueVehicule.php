<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueVehicule extends Model 
{

    protected $table = 'historiqueVehicules';
    public $timestamps = true;
    protected $fillable = array('ad', 'marque', 'model', 'immat', 'date_resiliation', 'motif');
    protected $dates = array('updated_at', 'created_at', 'date_resiliation');

    public function vehicules()
    {
        return $this->hasMany(Local::class);
    }
}