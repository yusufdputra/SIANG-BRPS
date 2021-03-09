<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpKedatangan extends Model
{
    use SoftDeletes;

    protected $table = 'op_kedatangans';

    protected $fillable = [
        'id_kendaraan','tanggal'
    ];


    public function kendaraans ()
    {
        return $this->belongsTo('App\Kendaraan', 'id_kendaraan');
    }

}
