<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewChamp extends Model
{
    protected $table = 'champsUpdate';
    public $timestamps = true;
    protected $fillable = array('old_name', 'new_name', 'table_name', 'status');


    public function scopeChamps($query)
    {
        return $query->select('champsUpdate.*');
    }
}
