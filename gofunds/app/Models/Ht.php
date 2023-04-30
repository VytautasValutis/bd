<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ht extends Model
{
    use HasFactory;
    public $table = 'ht_history';
    public $incrementing = false;
    public $keyType = 'unsignedBigInteger';
    protected $primaryKey = '_id';

    // protected $fillable = [
    //     "_id",
    //     "username",
    //     "password"
    // ];

    public function history()
    {
        return $this->belongsToMany(History::class, 'ht_pivots', 'histories__id', 'ht__id');
    }

}
