<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antenne extends Model
{
    protected $table = 'antennes';
    protected $fillable = array('antenne_name', 'numero_antenne');
    
    public $timestamps = false;

    public function Ads()
    {
        return $this->hasMany(Ad::class);
    }
    
}
