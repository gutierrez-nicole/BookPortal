<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = Loan::with('book')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where('borrower_name', 'like', "%{$search}%")
                      ->orWhereHas('book', fn($q) => $q->where('title', 'like', "%{$search}%"));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'overdue') {
                    $query->whereNull('returned_at')->where('due_date', '<', now()->startOfDay());
                } elseif ($request->status === 'returned') {
                    $query->whereNotNull('returned_at');
                } elseif ($request->status === 'active') {
                    $query->whereNull('returned_at');
                }
            })
            ->latest()
            ->paginate(15);

        return view('loans.index', compact('loans'));
    }
}
