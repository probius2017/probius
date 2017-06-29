<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model 
{

    protected $table = 'structures';
    public $timestamps = false;
    protected $fillable = array('type_structure');

    public function locaux()
    {
        return $this->belongsToMany(Local::class);
    }

}