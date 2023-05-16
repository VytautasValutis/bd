<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ht extends Model
{
    use HasFactory;

    protected $fillable = ['text'];


    public function htp()
    {
        return $this->hasMany(Ht::class, 'ht_pivots', 'hts__id', 'id');
    }

}
