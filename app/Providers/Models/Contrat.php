<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model 
{

    protected $table = 'contrats';
    public $timestamps = true;
    protected $fillable = array('num_contrat', 'name_contrat', 'intercalaire' );

    public function sinistres()
    {
        return $this->hasMany(Sinistre::class);
    }

    public function algeco()
    {
        return $this->belongsTo(Algeco::class);
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }

}