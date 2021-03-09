<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kedatangan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'jam','tanggal','id_kendaraan','penumpang','tujuan'
    ];



    public function kendaraan ()
    {
        return $this->belongsTo('App\Bus', 'id_kendaraan');
    }


}
