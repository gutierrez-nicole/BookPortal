<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Borrow Records</title>

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

        .sidebar-nav li a:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .sidebar-nav li.active a { background: rgba(201,151,58,0.15); color: var(--gold); }
        .sidebar-nav li a .nav-icon { width: 18px; height: 18px; opacity: 0.7; flex-shrink: 0; }
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

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.5rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            border: 1px solid var(--rule);
            color: var(--muted);
            background: #fff;
            transition: border-color 0.15s, color 0.15s;
        }

        .btn-outline:hover { border-color: var(--muted); color: var(--ink); }

        /* ── Summary chips ────────────────────────────── */
        .summary-row {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .summary-chip {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 10px;
            font-size: 0.78rem;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .summary-chip:hover { border-color: var(--muted); box-shadow: 0 2px 8px rgba(26,23,20,0.06); }
        .summary-chip.active-chip { border-color: currentColor; }

        .chip-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .chip-count {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1;
        }

        .chip-label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--muted);
        }

        .chip-total  .chip-dot { background: var(--ink); }
        .chip-active .chip-dot { background: var(--gold); }
        .chip-overdue .chip-dot { background: var(--accent); animation: pulse-red 1.8s infinite; }
        .chip-returned .chip-dot { background: var(--teal); }

        .chip-total   .chip-count { color: var(--ink); }
        .chip-active  .chip-count { color: #8a6115; }
        .chip-overdue .chip-count { color: var(--accent); }
        .chip-returned .chip-count { color: var(--teal); }

        @keyframes pulse-red {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }

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
            grid-template-columns: 1fr 200px auto auto;
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
            background: #fff;
        }

        .select-wrapper { position: relative; }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 0.75rem; top: 50%;
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

        .table-count { font-size: 0.78rem; color: var(--muted); }
        .table-count strong { font-weight: 700; color: var(--ink); }

        /* ── Loan table ───────────────────────────────── */
        .loan-table { width: 100%; border-collapse: collapse; }

        .loan-table thead th {
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

        .loan-table thead th:last-child { text-align: right; }

        .loan-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
            animation: rowIn 0.25s ease both;
        }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-5px); }
            to   { opacity: 1; transform: none; }
        }

        .loan-table tbody tr:nth-child(1)  { animation-delay: 0.03s; }
        .loan-table tbody tr:nth-child(2)  { animation-delay: 0.06s; }
        .loan-table tbody tr:nth-child(3)  { animation-delay: 0.09s; }
        .loan-table tbody tr:nth-child(4)  { animation-delay: 0.12s; }
        .loan-table tbody tr:nth-child(5)  { animation-delay: 0.15s; }
        .loan-table tbody tr:nth-child(6)  { animation-delay: 0.18s; }
        .loan-table tbody tr:nth-child(7)  { animation-delay: 0.21s; }
        .loan-table tbody tr:nth-child(8)  { animation-delay: 0.24s; }

        .loan-table tbody tr:last-child { border-bottom: none; }
        .loan-table tbody tr:hover { background: #fdfcfa; }

        /* Overdue row highlight */
        .loan-table tbody tr.row-overdue { background: #fff9f7; }
        .loan-table tbody tr.row-overdue:hover { background: #fff4f0; }

        .loan-table td {
            padding: 0.9rem 1.25rem;
            font-size: 0.84rem;
            vertical-align: middle;
        }

        /* Borrower cell */
        .borrower-cell { display: flex; align-items: center; gap: 0.6rem; }

        .borrower-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--rule);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; color: var(--muted);
            flex-shrink: 0;
        }

        .borrower-name { font-weight: 600; color: var(--ink); }

        /* Book cell */
        .book-link {
            font-family: 'Playfair Display', serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
            text-decoration: none;
            transition: color 0.13s;
        }

        .book-link:hover { color: var(--accent); }

        /* Date cells */
        .date-cell { font-size: 0.8rem; color: var(--muted); white-space: nowrap; }
        .date-overdue { color: var(--accent); font-weight: 600; }

        /* Duration chip */
        .duration-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.67rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            margin-left: 4px;
            white-space: nowrap;
        }

        .duration-over { background: var(--accent-lt); color: var(--accent); }
        .duration-ok   { background: var(--teal-lt); color: var(--teal); }

        /* Status badges */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 3px 10px; border-radius: 20px;
        }

        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }

        .badge-returned { background: var(--teal-lt); color: var(--teal); }
        .badge-returned .badge-dot { background: var(--teal); }

        .badge-overdue { background: var(--accent-lt); color: var(--accent); }
        .badge-overdue .badge-dot { background: var(--accent); animation: pulse-red 1.8s infinite; }

        .badge-active { background: var(--gold-lt); color: #8a6115; }
        .badge-active .badge-dot { background: var(--gold); }

        /* Action buttons */
        .actions-cell { text-align: right; white-space: nowrap; }

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

        .action-view    { color: var(--teal);  border-color: #b0d8d2; }
        .action-return  { color: var(--accent); border-color: #e8c4b8; }

        .action-view:hover   { background: var(--teal-lt); }
        .action-return:hover { background: var(--accent-lt); }

        /* Empty state */
        .empty-state { text-align: center; padding: 3.5rem 1rem; }
        .empty-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.3; }
        .empty-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--muted); margin-bottom: 0.3rem; }
        .empty-sub { font-size: 0.8rem; color: var(--muted); opacity: 0.7; }

        /* Pagination */
        .pagination-wrap {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--rule);
            background: #faf8f5;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 1100px) {
            .filter-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
            .filter-grid { grid-template-columns: 1fr; }
            .summary-row { gap: 0.5rem; }
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
        <li>
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
        <li class="active">
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
     MAIN
═══════════════════════════════════════════ --}}
<main class="main">

    {{-- Page header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Borrow <span>Records</span></h1>
            <p class="page-subtitle">Track all active, overdue, and returned loans.</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn-outline">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Books
        </a>
    </div>

    {{-- Summary chips --}}
    <div class="summary-row">
        <a href="{{ route('loans.index') }}" class="summary-chip chip-total {{ !request('status') ? 'active-chip' : '' }}">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $loans->total() }}</span>
            <span class="chip-label">Total</span>
        </a>
        <a href="{{ route('loans.index', ['status' => 'active']) }}" class="summary-chip chip-active {{ request('status') === 'active' ? 'active-chip' : '' }}">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $activeCount ?? $loans->where('returned_at', null)->count() }}</span>
            <span class="chip-label">Active</span>
        </a>
        <a href="{{ route('loans.index', ['status' => 'overdue']) }}" class="summary-chip chip-overdue {{ request('status') === 'overdue' ? 'active-chip' : '' }}">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $overdueCount ?? 0 }}</span>
            <span class="chip-label">Overdue</span>
        </a>
        <a href="{{ route('loans.index', ['status' => 'returned']) }}" class="summary-chip chip-returned {{ request('status') === 'returned' ? 'active-chip' : '' }}">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $returnedCount ?? $loans->where('returned_at', '!=', null)->count() }}</span>
            <span class="chip-label">Returned</span>
        </a>
    </div>

    {{-- Filter panel --}}
    <div class="filter-panel">
        <div class="filter-panel-label">Filter Records</div>
        <form method="GET">
            <div class="filter-grid">
                <div class="filter-field">
                    <label for="search">Search</label>
                    <input id="search" name="search" type="text"
                           placeholder="Borrower name or book title…"
                           value="{{ request('search') }}" />
                </div>
                <div class="filter-field">
                    <label for="status">Status</label>
                    <div class="select-wrapper">
                        <select id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="active"   @selected(request('status') === 'active')>Active</option>
                            <option value="overdue"  @selected(request('status') === 'overdue')>Overdue</option>
                            <option value="returned" @selected(request('status') === 'returned')>Returned</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-filter">Filter</button>
                <a href="{{ route('loans.index') }}" class="btn-clear">Clear</a>
            </div>
        </form>
    </div>

    {{-- Table card --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-count">
                Showing <strong>{{ $loans->count() }}</strong> of <strong>{{ $loans->total() }}</strong> records
            </span>
            @if(request()->hasAny(['search', 'status']))
                <span style="font-size:0.72rem; color:var(--accent); font-weight:600;">Filtered results</span>
            @endif
        </div>

        <div style="overflow-x: auto;">
            <table class="loan-table">
                <thead>
                    <tr>
                        <th>Borrower</th>
                        <th>Book</th>
                        <th>Borrowed</th>
                        <th>Due Date</th>
                        <th>Returned</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        @php
                            $isOverdue   = !$loan->returned_at && $loan->isOverdue();
                            $isReturned  = (bool) $loan->returned_at;
                        @endphp
                        <tr class="{{ $isOverdue ? 'row-overdue' : '' }}">

                            {{-- Borrower --}}
                            <td>
                                <div class="borrower-cell">
                                    <div class="borrower-avatar">{{ strtoupper(substr($loan->borrower_name, 0, 1)) }}</div>
                                    <span class="borrower-name">{{ $loan->borrower_name }}</span>
                                </div>
                            </td>

                            {{-- Book --}}
                            <td>
                                <a href="{{ route('books.show', $loan->book) }}" class="book-link">
                                    {{ $loan->book->title }}
                                </a>
                            </td>

                            {{-- Borrowed date --}}
                            <td class="date-cell">{{ $loan->borrowed_at->format('M d, Y') }}</td>

                            {{-- Due date --}}
                            <td>
                                <span class="date-cell {{ $isOverdue ? 'date-overdue' : '' }}">
                                    {{ $loan->due_date->format('M d, Y') }}
                                </span>
                                @if($isOverdue)
                                    <span class="duration-chip duration-over">
                                        {{ $loan->due_date->diffInDays(now()) }}d overdue
                                    </span>
                                @elseif(!$isReturned)
                                    @php $daysLeft = now()->diffInDays($loan->due_date, false); @endphp
                                    @if($daysLeft <= 3 && $daysLeft >= 0)
                                        <span class="duration-chip duration-over">{{ $daysLeft }}d left</span>
                                    @endif
                                @endif
                            </td>

                            {{-- Returned date --}}
                            <td class="date-cell">
                                {{ $loan->returned_at ? $loan->returned_at->format('M d, Y') : '—' }}
                            </td>

                            {{-- Status badge --}}
                            <td>
                                @if($isReturned)
                                    <span class="badge badge-returned">
                                        <span class="badge-dot"></span> Returned
                                    </span>
                                @elseif($isOverdue)
                                    <span class="badge badge-overdue">
                                        <span class="badge-dot"></span> Overdue
                                    </span>
                                @else
                                    <span class="badge badge-active">
                                        <span class="badge-dot"></span> Active
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="actions-cell">
                                <a href="{{ route('books.show', $loan->book) }}" class="action-btn action-view">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    View
                                </a>
                                @if(!$isReturned)
                                    <form action="{{ route('books.return', $loan->book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-btn action-return">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            Return
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">📋</div>
                                    <div class="empty-title">No records found</div>
                                    <div class="empty-sub">Try adjusting your search or filter.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($loans->hasPages())
            <div class="pagination-wrap">
                {{ $loans->withQueryString()->links() }}
            </div>
        @endif
    </div>

</main>

</body>
</html>