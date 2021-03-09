<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_provinsi','slug'
    ];

    public function terminal ()
    {
        return $this->hasMany('App\Terminal', 'provinsi_id');
    }


}
