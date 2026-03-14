<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Books</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --cream:     #faf7f2;
            --ink:       #1a1714;
            --muted:     #6b6560;
            --rule:      #e8e2d9;
            --accent:    #b5451b;
            --accent-lt: #f5e8e3;
            --gold:      #c9973a;
            --gold-lt:   #fdf3e0;
            --teal:      #1d6b5e;
            --teal-lt:   #e3f0ee;
            --sidebar-w: 260px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ─────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            padding: 0 0 2rem;
        }

        .sidebar-brand {
            padding: 2rem 1.75rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #fff;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .sidebar-brand-name em { font-style: italic; color: var(--gold); }

        .sidebar-brand-sub {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.3);
            margin-top: 0.35rem;
        }

        .sidebar-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: rgba(255,255,255,0.25);
            padding: 1.5rem 1.75rem 0.5rem;
        }

        .sidebar-nav { list-style: none; padding: 0 0.75rem; }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li.active a {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }

        .sidebar-nav li.active a {
            background: rgba(201,151,58,0.15);
            color: var(--gold);
        }

        .sidebar-nav li a .nav-icon {
            width: 18px; height: 18px;
            opacity: 0.7; flex-shrink: 0;
        }

        .sidebar-nav li.active a .nav-icon { opacity: 1; }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem 1.75rem 0;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-user { display: flex; align-items: center; gap: 0.75rem; }

        .sidebar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.8rem;
            color: var(--ink); flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 0.8rem; font-weight: 600; color: rgba(255,255,255,0.8); }
        .sidebar-user-role { font-size: 0.7rem; color: rgba(255,255,255,0.3); }

        /* ── Main ─────────────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            padding: 2.5rem 2.5rem 4rem;
        }

        /* ── Page header ─────────────────────────────── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--rule);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .page-title span { font-style: italic; color: var(--muted); }
        .page-subtitle { font-size: 0.8rem; color: var(--muted); margin-top: 0.4rem; }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            background: var(--accent);
            color: #fff;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            letter-spacing: 0.02em;
        }

        .btn-primary:hover { background: #9b3a15; transform: translateY(-1px); }

        /* ── Flash messages ──────────────────────────── */
        .flash {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: none; } }

        .flash-success { background: var(--teal-lt); color: var(--teal); border: 1px solid #b0d8d2; }
        .flash-error   { background: var(--accent-lt); color: var(--accent); border: 1px solid #e8c4b8; }

        /* ── Filter panel ────────────────────────────── */
        .filter-panel {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-panel-label {
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 180px 160px auto auto;
            gap: 0.75rem;
            align-items: end;
        }

        .filter-field { display: flex; flex-direction: column; gap: 0.3rem; }

        .filter-field label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
        }

        .filter-field input,
        .filter-field select {
            height: 36px;
            padding: 0 0.75rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            color: var(--ink);
            background: var(--cream);
            border: 1px solid var(--rule);
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-field input:focus,
        .filter-field select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,151,58,0.12);
        }

        .select-wrapper { position: relative; }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0; height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--muted);
            pointer-events: none;
        }

        .btn-filter {
            height: 36px;
            padding: 0 1.1rem;
            background: var(--ink);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-filter:hover { background: #2e2a27; }

        .btn-clear {
            height: 36px;
            padding: 0 1rem;
            background: transparent;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            border: 1px solid var(--rule);
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: border-color 0.15s, color 0.15s;
            white-space: nowrap;
        }

        .btn-clear:hover { border-color: var(--muted); color: var(--ink); }

        /* ── Table card ───────────────────────────────── */
        .table-card {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            overflow: hidden;
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--rule);
        }

        .table-count {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .table-count strong {
            font-weight: 700;
            color: var(--ink);
        }

        /* ── Book table ───────────────────────────────── */
        .book-table {
            width: 100%;
            border-collapse: collapse;
        }

        .book-table thead th {
            background: #faf8f5;
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.11em;
            color: var(--muted);
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--rule);
            white-space: nowrap;
        }

        .book-table thead th:last-child { text-align: right; }

        .book-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
            animation: rowIn 0.25s ease both;
        }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-6px); }
            to   { opacity: 1; transform: none; }
        }

        .book-table tbody tr:nth-child(1)  { animation-delay: 0.03s; }
        .book-table tbody tr:nth-child(2)  { animation-delay: 0.06s; }
        .book-table tbody tr:nth-child(3)  { animation-delay: 0.09s; }
        .book-table tbody tr:nth-child(4)  { animation-delay: 0.12s; }
        .book-table tbody tr:nth-child(5)  { animation-delay: 0.15s; }
        .book-table tbody tr:nth-child(6)  { animation-delay: 0.18s; }
        .book-table tbody tr:nth-child(7)  { animation-delay: 0.21s; }
        .book-table tbody tr:nth-child(8)  { animation-delay: 0.24s; }
        .book-table tbody tr:nth-child(9)  { animation-delay: 0.27s; }
        .book-table tbody tr:nth-child(10) { animation-delay: 0.30s; }

        .book-table tbody tr:last-child { border-bottom: none; }
        .book-table tbody tr:hover { background: #fdfcfa; }

        .book-table td {
            padding: 0.9rem 1.25rem;
            font-size: 0.84rem;
            vertical-align: middle;
        }

        /* Cover cell */
        .book-cover-cell {
            width: 48px;
        }

        .book-cover-thumb {
            width: 40px;
            height: 56px;
            border-radius: 4px;
            object-fit: cover;
            box-shadow: 1px 2px 6px rgba(26,23,20,0.15);
            display: block;
        }

        .book-cover-placeholder {
            width: 40px;
            height: 56px;
            border-radius: 4px;
            background: var(--rule);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            opacity: 0.5;
        }

        /* Title cell */
        .book-title-cell .title-text {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
            display: block;
        }

        .book-title-cell .isbn-text {
            font-size: 0.68rem;
            color: var(--muted);
            margin-top: 2px;
            display: block;
            font-family: 'DM Sans', sans-serif;
        }

        /* Author cell */
        .author-text { color: var(--muted); font-size: 0.82rem; }

        /* Genre badge */
        .genre-pill {
            display: inline-block;
            font-size: 0.67rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            background: #f0eee9;
            color: var(--muted);
            white-space: nowrap;
        }

        /* Status badges */
        .status-available {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--teal-lt);
            color: var(--teal);
        }

        .status-borrowed {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--gold-lt);
            color: #8a6115;
        }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        .status-available .status-dot { background: var(--teal); }
        .status-borrowed  .status-dot { background: var(--gold); }

        /* Actions cell */
        .actions-cell {
            text-align: right;
            white-space: nowrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            background: transparent;
            transition: background 0.13s, color 0.13s, border-color 0.13s;
        }

        .action-view  { color: var(--teal);   border-color: #b0d8d2; }
        .action-edit  { color: #2563eb;        border-color: #bfdbfe; }
        .action-delete{ color: var(--accent);  border-color: #e8c4b8; }

        .action-view:hover   { background: var(--teal-lt); }
        .action-edit:hover   { background: #eff6ff; }
        .action-delete:hover { background: var(--accent-lt); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.3;
        }

        .empty-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--muted);
            margin-bottom: 0.3rem;
        }

        .empty-sub { font-size: 0.8rem; color: var(--muted); opacity: 0.7; }

        /* Pagination */
        .pagination-wrap {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--rule);
            background: #faf8f5;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 1200px) {
            .filter-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
            .filter-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════ --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-name">Book<em>Portal</em></div>
        <div class="sidebar-brand-sub">Library Management</div>
    </div>

    <span class="sidebar-section-label">Main</span>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('dashboard') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/>
                    <rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
                </svg>
                Dashboard
            </a>
        </li>
        <li class="active">
            <a href="{{ route('books.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                </svg>
                Browse Books
            </a>
        </li>
        <li>
            <a href="{{ route('books.create') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
                Add New Book
            </a>
        </li>
    </ul>

    <span class="sidebar-section-label">Circulation</span>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('loans.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                    <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                </svg>
                Borrow Records
            </a>
        </li>
        <li>
            <a href="{{ route('reservations.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Reservations
            </a>
        </li>
    </ul>

    <span class="sidebar-section-label">Insights</span>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('reports.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/>
                </svg>
                Reports
            </a>
        </li>
        <li>
            <a href="{{ route('activity.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
                Activity Log
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'L', 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Librarian' }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>
    </div>
</aside>


{{-- ═══════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════ --}}
<main class="main">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Book <span>Catalogue</span></h1>
            <p class="page-subtitle">Search, filter, and manage your entire library collection.</p>
        </div>
        <a href="{{ route('books.create') }}" class="btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Book
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="flash flash-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flash flash-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Filter Panel --}}
    <div class="filter-panel">
        <div class="filter-panel-label">Filter Books</div>
        <form method="GET">
            <div class="filter-grid">
                <div class="filter-field">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" placeholder="Search by title…" value="{{ request('title') }}" />
                </div>
                <div class="filter-field">
                    <label for="author">Author</label>
                    <input id="author" name="author" type="text" placeholder="Search by author…" value="{{ request('author') }}" />
                </div>
                <div class="filter-field">
                    <label for="genre">Genre</label>
                    <div class="select-wrapper">
                        <select id="genre" name="genre">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" @selected(request('genre') === $genre)>{{ $genre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="filter-field">
                    <label for="available">Availability</label>
                    <div class="select-wrapper">
                        <select id="available" name="available">
                            <option value="">Any Status</option>
                            <option value="1" @selected(request('available') === '1')>Available</option>
                            <option value="0" @selected(request('available') === '0')>Borrowed</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-filter">Filter</button>
                <a href="{{ route('books.index') }}" class="btn-clear">Clear</a>
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-count">
                Showing <strong>{{ $books->count() }}</strong> of <strong>{{ $books->total() }}</strong> books
            </span>
            @if(request()->hasAny(['title','author','genre','available']))
                <span style="font-size:0.72rem; color:var(--accent); font-weight:600;">Filtered results</span>
            @endif
        </div>

        <div style="overflow-x: auto;">
            <table class="book-table">
                <thead>
                    <tr>
                        <th class="book-cover-cell">Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            {{-- Cover --}}
                            <td class="book-cover-cell">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                                         alt="{{ $book->title }}"
                                         class="book-cover-thumb" />
                                @else
                                    <div class="book-cover-placeholder">📕</div>
                                @endif
                            </td>

                            {{-- Title + ISBN --}}
                            <td class="book-title-cell">
                                <span class="title-text">{{ $book->title }}</span>
                                @if(isset($book->isbn) && $book->isbn)
                                    <span class="isbn-text">ISBN {{ $book->isbn }}</span>
                                @endif
                            </td>

                            {{-- Author --}}
                            <td><span class="author-text">{{ $book->author }}</span></td>

                            {{-- Genre --}}
                            <td>
                                @if($book->genre)
                                    <span class="genre-pill">{{ $book->genre }}</span>
                                @else
                                    <span style="color:var(--rule); font-size:0.75rem;">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($book->available)
                                    <span class="status-available">
                                        <span class="status-dot"></span> Available
                                    </span>
                                @else
                                    <span class="status-borrowed">
                                        <span class="status-dot"></span> Borrowed
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="actions-cell">
                                <a href="{{ route('books.show', $book) }}" class="action-btn action-view">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    View
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="action-btn action-edit">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete {{ addslashes($book->title) }}? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-delete">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">📚</div>
                                    <div class="empty-title">No books found</div>
                                    <div class="empty-sub">Try adjusting your filters or add a new book.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($books->hasPages())
            <div class="pagination-wrap">
                {{ $books->withQueryString()->links() }}
            </div>
        @endif
    </div>

</main>

</body>
</html>