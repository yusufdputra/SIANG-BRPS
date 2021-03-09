<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_kategori','slug'
    ];

    public function keberangkatan ()
    {
        return $this->hasMany('App\Keberangkatan', 'bus_id');
    }

    
}
