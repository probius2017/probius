<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChambreFroide extends Model
{
    protected $table = 'chambresFroides';
    public $timestamps = true;
    protected $fillable = array('volume');
    protected $dates = ['created_at', 'updated_at', 'date_delete'];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
