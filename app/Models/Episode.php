<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    protected $fillable = ['number'];

    public function season()
    {
        // um episódio tem uma temporada
        return $this->belongsTo(Season::class);
    }
}
