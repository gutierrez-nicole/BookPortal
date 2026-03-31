<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Notification;
use App\Models\Receipt;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected function getAuthorNameParts(Book $book): array
    {
        if ($book->last_name || $book->first_name || $book->middle_initial) {
            return [
                'last_name' => $book->last_name,
                'first_name' => $book->first_name,
                'middle_initial' => $book->middle_initial,
            ];
        }

        $parts = preg_split('/\s+/', trim((string) $book->author)) ?: [];

        return [
            'first_name' => $parts[0] ?? '',
            'last_name' => count($parts) > 1 ? end($parts) : '',
            'middle_initial' => count($parts) > 2 ? strtoupper(substr($parts[1], 0, 1)) : '',
        ];
    }

    protected function formatAuthorName(array $data): string
    {
        $middleInitial = trim((string) ($data['middle_initial'] ?? ''));
        $middleInitial = $middleInitial !== '' ? strtoupper(rtrim($middleInitial, '.')) . '.' : '';

        return trim(implode(' ', array_filter([
            trim((string) ($data['first_name'] ?? '')),
            $middleInitial,
            trim((string) ($data['last_name'] ?? '')),
        ])));
    }

    protected function formatBorrowerName(array $data): string
    {
        if (!empty($data['borrower_name'])) {
            return trim((string) $data['borrower_name']);
        }

        $middleInitial = trim((string) ($data['middle_initial'] ?? ''));
        $middleInitial = $middleInitial !== '' ? strtoupper(rtrim($middleInitial, '.')) . '.' : '';

        return trim(implode(' ', array_filter([
            trim((string) ($data['first_name'] ?? '')),
            $middleInitial,
            trim((string) ($data['last_name'] ?? '')),
        ])));
    }

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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:5',
            'genre' => 'required',
            'isbn' => 'required|unique:books',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data['author'] = $this->formatAuthorName($data);

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

        Notification::create([
            'type' => 'book_added',
            'title' => 'New Book Added',
            'message' => "Book '{$book->title}' by {$book->author} has been added to the library.",
            'data' => ['book_id' => $book->id, 'user_id' => auth()->id()],
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authorNameParts = $this->getAuthorNameParts($book);

        return view('books.edit', compact('book', 'authorNameParts'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:5',
            'genre' => 'required',
            'isbn' => 'required|unique:books,isbn,'.$book->id,
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data['author'] = $this->formatAuthorName($data);

        if ($request->hasFile('cover_image')) {
            // Delete the previous cover file when replacing it to keep storage clean.
            if ($book->cover_image) {
                \Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        } else {
            // Preserve the existing cover image when no new file is uploaded.
            unset($data['cover_image']);
        }

        $book->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['title' => $book->title, 'isbn' => $book->isbn],
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Book updated!');
    }

    public function inventory()
    {
        $books = Book::where('available', true)
            ->orderBy('title')
            ->paginate(12);

        return view('books.inventory', compact('books'));
    }

    // === BORROW ===
    public function borrow(Request $request, Book $book)
    {
        $data = $request->validate([
            'borrower_name' => 'nullable|string|max:255',
            'last_name' => 'required_without:borrower_name|string|max:255',
            'first_name' => 'required_without:borrower_name|string|max:255',
            'middle_initial' => 'nullable|string|max:5',
            'due_date' => 'required|date|after:today',
        ]);

        $borrowerName = $this->formatBorrowerName($data);

        if ($borrowerName === '') {
            return back()
                ->withErrors(['borrower_name' => 'Borrower name is required.'])
                ->withInput();
        }

        if (!$book->available) {
            return back()->with('error', 'Book is not available!');
        }

        $loan = Loan::create([
            'book_id' => $book->id,
            'borrower_name' => $borrowerName,
            'borrowed_at' => now(),
            'due_date' => $data['due_date'],
        ]);

        $book->update(['available' => false]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'borrowed_book',
            'subject_type' => Book::class,
            'subject_id' => $book->id,
            'metadata' => ['loan_id' => $loan->id, 'borrower' => $loan->borrower_name],
        ]);

        Notification::create([
            'type' => 'book_borrowed',
            'title' => 'Book Borrowed',
            'message' => "Book '{$book->title}' has been borrowed by {$loan->borrower_name}.",
            'data' => ['book_id' => $book->id, 'loan_id' => $loan->id, 'user_id' => auth()->id()],
        ]);

        return redirect()
            ->route('books.show', $book)
            ->with('success', "Book borrowed successfully by {$loan->borrower_name}.");
    }

    // === BULK BORROW ===
    public function borrowBulk(Request $request)
    {
        $data = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'book_ids' => 'required|array|min:2',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        // Load books and verify all are available
        $books = Book::whereIn('id', $data['book_ids'])->lockForUpdate()->get();
        if ($books->count() !== count($data['book_ids'])) {
            return back()->with('error', 'Some books could not be found.');
        }

        $unavailable = $books->where('available', false)->pluck('title')->toArray();
        if (!empty($unavailable)) {
            return back()->with('error', 'These books are not available: '.implode(', ', $unavailable));
        }

        // Create loans and mark books unavailable
        $items = [];
        foreach ($books as $book) {
            $loan = Loan::create([
                'book_id' => $book->id,
                'borrower_name' => $data['borrower_name'],
                'borrowed_at' => now(),
                'due_date' => $data['due_date'],
            ]);

            $book->update(['available' => false]);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'borrowed_book',
                'subject_type' => Book::class,
                'subject_id' => $book->id,
                'metadata' => ['loan_id' => $loan->id, 'borrower' => $loan->borrower_name],
            ]);

            $items[] = [
                'book_id' => $book->id,
                'title' => $book->title,
                'quantity' => 1,
            ];
        }

        $receipt = Receipt::create([
            'borrower_name' => $data['borrower_name'],
            'items' => $items,
            'total_amount' => 0,
            'transaction_date' => now(),
        ]);

        // Render receipt HTML page with option to download PDF
        return redirect()->route('loans.index')->with('success', 'Borrowed '.count($items).' books. Receipt #'.$receipt->id.' generated.');
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

        Notification::create([
            'type' => 'book_returned',
            'title' => 'Book Returned',
            'message' => "Book '{$book->title}' has been returned by {$loan->borrower_name}." . ($lateFee > 0 ? " Late fee: ₱" . number_format($lateFee, 2) : ""),
            'data' => ['book_id' => $book->id, 'loan_id' => $loan->id, 'late_fee' => $lateFee, 'user_id' => auth()->id()],
        ]);

        return back()->with('success', 'Book returned! Late fee: ₱'.number_format($lateFee, 2));
    }
}
