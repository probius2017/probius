<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChambreFroide extends Model
{
    protected $table = 'chambresFroides';
    public $timestamps = true;
    protected $fillable = array('volume');

    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
