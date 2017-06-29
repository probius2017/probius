<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = array('type');

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }

}