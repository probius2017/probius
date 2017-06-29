<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model 
{

    protected $table = 'modeles';
    public $timestamps = false;
    protected $fillable = array('name_modele');

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}