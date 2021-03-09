<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keberangkatan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'jam','tanggal','penumpang','id_kendaraan','tujuan'
    ];



    public function kendaraan ()
    {
        return $this->belongsTo('App\Kendaraan', 'id_kendaraan');
    }




}
