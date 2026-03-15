<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_name',
        'items', // JSON array of items
        'total_amount',
        'transaction_date',
    ];

    protected $casts = [
        'items' => 'array',
        'transaction_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];
}
