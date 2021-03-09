<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use SoftDeletes;

    protected $table = 'kendaraans';

    protected $fillable = [
        'plat_nomor','bus_id', 'po_id'
    ];

    public function bus ()
    {
        return $this->belongsTo('App\Bus', 'bus_id');
    }
    
    public function po ()
    {
        return $this->belongsTo('App\Po', 'po_id');
    }
    
}
