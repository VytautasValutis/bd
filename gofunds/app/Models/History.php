<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $table = 'table_history';
    public $incrementing = false;
    public $keyType = 'unsignedBigInteger';
    protected $primaryKey = '_id';

    // protected $fillable = [
    //     "_id",
    //     "username",
    //     "password"
    // ];

    public function ht()
    {
        return $this->belongsToMany(Ht::class, 'ht_pivots', 'histories__id', 'ht__id');
    }
}
