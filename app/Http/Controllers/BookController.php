<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query()
            ->when($request->filled('title'), fn($q) => $q->where('title', 'like', '%'.$request->title.'%'))
            ->when($request->filled('author'), fn($q) => $q->where('author', 'like', '%'.$request->author.'%'))
            ->when($request->filled('genre'), fn($q) => $q->where('genre', $request->genre))
            ->when($request->filled('available'), fn($q) => $q->where('available', $request->available))
            ->latest()
            ->paginate(12);

        $genres = Book::distinct()->pluck('genre');

        return view('books.index', compact('books', 'genres'));
    }

    public function create() { return view('books.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'isbn' => 'required|unique:books',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Book::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'created_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['title' => $book->title, 'isbn' => $book->isbn],
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'isbn' => 'required|unique:books,isbn,'.$book->id,
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['title' => $book->title, 'isbn' => $book->isbn],
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            \Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['title' => $book->title, 'isbn' => $book->isbn],
        ]);

        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }

    // === BORROW ===
    public function borrow(Request $request, Book $book)
    {
        $request->validate([
            'borrower_name' => 'required',
            'due_date' => 'required|date|after:today',
        ]);

        if (!$book->available) {
            return back()->with('error', 'Book is not available!');
        }

        $loan = Loan::create([
            'book_id' => $book->id,
            'borrower_name' => $request->borrower_name,
            'borrowed_at' => now(),
            'due_date' => $request->due_date,
        ]);

        $book->update(['available' => false]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'borrowed_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['loan_id' => $loan->id, 'borrower' => $loan->borrower_name],
        ]);

        $pdf = Pdf::loadView('pdf.receipt', compact('loan', 'book'));
        return $pdf->download('receipt-'.$loan->id.'.pdf');
    }

    // === RETURN ===
    public function returnBook(Book $book)
    {
        $loan = $book->currentLoan();
        if (!$loan) return back()->with('error', 'No active loan!');

        $lateFee = $loan->calculateLateFee();

        $loan->update([
            'returned_at' => now(),
            'late_fee' => $lateFee,
        ]);

        $book->update(['available' => true]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'returned_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['loan_id' => $loan->id, 'late_fee' => $lateFee],
        ]);

        return back()->with('success', 'Book returned! Late fee: ₱'.number_format($lateFee, 2));
    }
}