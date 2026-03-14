<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'reserved_by',
        'reserved_at',
        'expires_at',
        'status',
        'created_by',
    ];

    protected $casts = [
        'reserved_at' => 'date',
        'expires_at' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
