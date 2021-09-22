<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $timestamps = false;
    protected $fillable = ['number'];

    public function episodes()
    {
        // uma temporada tem muitos epsódios
        return $this->hasMany(Episode::class);
    }

    public function serie()
    {
        // uma temporada pertence a uma série
        return $this->belongsTo(Serie::class);
    }

    public function getWatchedEpisodes(): Collection
    {
        return $this->episodes->filter(function (Episode $episode) {
            return $episode->watched;
        });
    }
}
