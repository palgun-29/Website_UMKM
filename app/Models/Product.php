<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Definisikan kolom yang diizinkan untuk diisi massal
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'image',
        'alt',
    ];
}