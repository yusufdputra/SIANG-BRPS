<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Po extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_po','slug', 'user_id'
    ];

    public function keberangkatan ()
    {
        return $this->hasMany('App\Keberangkatan', 'po_id');
    }

    public function po ()
    {
        return $this->hasMany('App\Po', 'id');
    }

    public function users ()
    {
        return $this->belongsTo('App\Users', 'user_id');
    }
}
