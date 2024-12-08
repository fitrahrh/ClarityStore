<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan plural bentuk standar
    protected $table = 'transactions';

    // Tentukan field yang dapat diisi mass-assignment
    protected $fillable = [
        'merchant_ref',
        'user_name',
        'amount',
        'status',
    ];

    // Tentukan field yang tidak boleh diisi (optional)
    // protected $guarded = [];
}
