<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','author','genre','isbn','cover_image','available'];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function currentLoan()
    {
        return $this->loans()->whereNull('returned_at')->first();
    }
}