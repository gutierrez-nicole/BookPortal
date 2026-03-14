<?php
namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBooks'    => Book::count(),
            'borrowedBooks' => Loan::whereNull('returned_at')->count(),
            'overdueBooks'  => Loan::whereNull('returned_at')
                                   ->where('due_date', '<', now()->startOfDay())
                                   ->count(),
            'recentLoans'   => Loan::with('book')->latest()->take(8)->get(),
            'latestBooks'   => Book::latest()->take(6)->get(),
        ]);
    }
}