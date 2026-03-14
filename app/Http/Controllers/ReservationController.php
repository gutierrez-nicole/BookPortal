<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with(['book', 'creator'])
            ->latest()
            ->paginate(15);

        return view('reservations.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $book = null;
        if ($request->filled('book')) {
            $book = Book::find($request->query('book'));
        }

        $books = Book::orderBy('title')->get();

        return view('reservations.create', compact('book', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'reserved_by' => 'required|string|max:255',
            'reserved_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:reserved_at',
        ]);

        $book = Book::findOrFail($data['book_id']);

        $reservation = Reservation::create([
            'book_id' => $book->id,
            'reserved_by' => $data['reserved_by'],
            'reserved_at' => $data['reserved_at'] ?? now()->toDateString(),
            'expires_at' => $data['expires_at'],
            'created_by' => auth()->id(),
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'reserved_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['reservation_id' => $reservation->id],
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'cancelled_reservation',
            'subject_type' => Reservation::class,
            'subject_id' => $reservation->id,
        ]);

        return back()->with('success', 'Reservation cancelled.');
    }
}
