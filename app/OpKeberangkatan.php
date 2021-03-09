<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpKeberangkatan extends Model
{
    use SoftDeletes;

    protected $table = 'op_keberangkatans';

    protected $fillable = [
        'id_kendaraan','tanggal', 'status'
    ];


    public function kendaraans ()
    {
        return $this->belongsTo('App\Kendaraan', 'id_kendaraan');
    }
    
}
