<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ht_pivot extends Model
{
    use HasFactory;
    protected $fillable = ['histories__id', 'hts__id'];
}
