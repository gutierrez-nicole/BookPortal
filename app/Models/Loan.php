<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'borrower_name',
        'borrowed_at',
        'due_date',
        'returned_at',
        'late_fee',
        'late_fee_paid',
    ];

    protected $casts = [
        'borrowed_at' => 'date',
        'due_date' => 'date',
        'returned_at' => 'date',
        'late_fee' => 'decimal:2',
        'late_fee_paid' => 'boolean',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        if ($this->returned_at) {
            return false;
        }

        return $this->due_date && $this->due_date->isBefore(now()->startOfDay());
    }

    public function calculateLateFee(float $dailyRate = 50.00): float
    {
        if (! $this->due_date || $this->returned_at) {
            return 0.0;
        }

        $daysLate = now()->startOfDay()->diffInDays($this->due_date->startOfDay(), false);

        if ($daysLate >= 0) {
            return 0.0;
        }

        return abs($daysLate) * $dailyRate;
    }
}
