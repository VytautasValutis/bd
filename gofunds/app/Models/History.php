<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'story', 'need_money', 'have_money', 'lack_money', 'like', 'photo', 'approved', ];


    public function ht()
    {
        return $this->belongsToMany(Ht::class, 'ht_pivots', 'histories__id', 'ht__id');
    }
}
