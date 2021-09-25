<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model 
{
    public $timestamps = false;
    protected $fillable = ['name', 'cover']; //campos da tabela

    public function getCoverUrlAttribute()
    {   
        $withoutImg = 'serie/without-image.jpg';

        if ($this->cover) {
            return Storage::url($this->cover);
        }

        return Storage::url($withoutImg);
    }

    public function seasons()
    {
        // uma série tem muitas temporadas
        return $this->hasMany(Season::class);
    }
}