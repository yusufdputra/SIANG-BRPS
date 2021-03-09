<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terminal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_terminal','slug','provinsi_id'
    ];

    public function provinsi ()
    {
        return $this->belongsTo('App\Provinsi', 'provinsi_id');
    }


}
