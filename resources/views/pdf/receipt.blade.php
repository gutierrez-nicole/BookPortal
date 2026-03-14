<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrow Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .header h1 { margin: 0; font-size: 24px; }
        .section { margin-bottom: 18px; }
        .label { font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background: #f4f4f4; text-align: left; }
        .footer { margin-top: 24px; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Borrow Receipt</h1>
            <div>Receipt #: {{ $loan->id }}</div>
        </div>
        <div>
            <div><strong>Date:</strong> {{ now()->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="section">
        <div class="label">Borrower</div>
        <div>{{ $loan->borrower_name }}</div>
    </div>

    <div class="section">
        <div class="label">Book</div>
        <div>{{ $book->title }} by {{ $book->author }}</div>
        <div><strong>ISBN:</strong> {{ $book->isbn }}</div>
        <div><strong>Genre:</strong> {{ $book->genre }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $loan->borrowed_at->format('M d, Y') }}</td>
                <td>{{ $loan->due_date->format('M d, Y') }}</td>
                <td>{{ $loan->isOverdue() ? 'Overdue' : 'On Time' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Thank you for using BookPortal. Please return the book by the due date to avoid late fees.
    </div>
</body>
</html>
