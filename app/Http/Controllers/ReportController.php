<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $mostBorrowed = Loan::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10)
            ->get();

        $overdueByBorrower = Loan::select('borrower_name', DB::raw('count(*) as total'))
            ->whereNull('returned_at')
            ->where('due_date', '<', now()->startOfDay())
            ->groupBy('borrower_name')
            ->orderByDesc('total')
            ->take(10)
            ->get();

        $stockByGenre = Book::select('genre', DB::raw('count(*) as total'))
            ->groupBy('genre')
            ->orderByDesc('total')
            ->get();

        return view('reports.index', compact('mostBorrowed', 'overdueByBorrower', 'stockByGenre'));
    }
}
