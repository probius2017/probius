<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    protected $table = 'logements';
    public $timestamps = true;
    protected $fillable = array();
    protected $dates = ['created_at', 'updated_at'];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function sinistres()
    {
        return $this->hasManyThrough('App\Models\Sinistre', 'App\Models\Contrat');
    }

    public function bail()
    {
        return $this->belongsTo(Bail::class);
    }
}
