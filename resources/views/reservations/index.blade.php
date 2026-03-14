<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Reservations</title>

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
            --indigo:    #3b4fd8;
            --indigo-lt: #eef0fd;
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

        .header-actions { display: flex; gap: 0.6rem; align-items: center; }

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

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            color: #fff;
            background: var(--indigo);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.15s, transform 0.1s;
            cursor: pointer;
        }

        .btn-primary:hover { background: #2e3db8; transform: translateY(-1px); }

        /* ── Flash ───────────────────────────────────── */
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
            border: 1px solid #b0d8d2;
            background: var(--teal-lt);
            color: var(--teal);
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: none; } }

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

        .chip-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

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

        .chip-total   .chip-dot { background: var(--ink); }
        .chip-pending .chip-dot { background: var(--indigo); animation: pulse-indigo 2s infinite; }
        .chip-ready   .chip-dot { background: var(--teal); }
        .chip-cancelled .chip-dot { background: var(--muted); }

        .chip-total     .chip-count { color: var(--ink); }
        .chip-pending   .chip-count { color: var(--indigo); }
        .chip-ready     .chip-count { color: var(--teal); }
        .chip-cancelled .chip-count { color: var(--muted); }

        @keyframes pulse-indigo {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }

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

        .table-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .table-count { font-size: 0.78rem; color: var(--muted); }
        .table-count strong { font-weight: 700; color: var(--ink); }

        /* ── Reservations table ───────────────────────── */
        .res-table { width: 100%; border-collapse: collapse; }

        .res-table thead th {
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

        .res-table thead th:last-child { text-align: right; }

        .res-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
            animation: rowIn 0.25s ease both;
        }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-5px); }
            to   { opacity: 1; transform: none; }
        }

        .res-table tbody tr:nth-child(1) { animation-delay: 0.03s; }
        .res-table tbody tr:nth-child(2) { animation-delay: 0.06s; }
        .res-table tbody tr:nth-child(3) { animation-delay: 0.09s; }
        .res-table tbody tr:nth-child(4) { animation-delay: 0.12s; }
        .res-table tbody tr:nth-child(5) { animation-delay: 0.15s; }
        .res-table tbody tr:nth-child(6) { animation-delay: 0.18s; }
        .res-table tbody tr:nth-child(7) { animation-delay: 0.21s; }
        .res-table tbody tr:nth-child(8) { animation-delay: 0.24s; }

        .res-table tbody tr:last-child { border-bottom: none; }
        .res-table tbody tr:hover { background: #fdfcfa; }

        .res-table td {
            padding: 0.9rem 1.25rem;
            font-size: 0.84rem;
            vertical-align: middle;
        }

        /* Book cell */
        .book-cell { display: flex; align-items: center; gap: 0.75rem; }

        .book-thumb {
            width: 34px; height: 46px;
            border-radius: 4px;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 1px 2px 6px rgba(26,23,20,0.13);
        }

        .book-thumb-placeholder {
            width: 34px; height: 46px;
            border-radius: 4px;
            background: var(--rule);
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; opacity: 0.4;
        }

        .book-title-link {
            font-family: 'Playfair Display', serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
            text-decoration: none;
            line-height: 1.3;
            display: block;
            transition: color 0.13s;
        }

        .book-title-link:hover { color: var(--accent); }

        .book-author-small {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 1px;
        }

        /* Reserver cell */
        .reserver-cell { display: flex; align-items: center; gap: 0.6rem; }

        .reserver-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--indigo-lt);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.68rem; font-weight: 700;
            color: var(--indigo);
            flex-shrink: 0;
        }

        .reserver-name { font-weight: 600; font-size: 0.84rem; }

        /* Date cell */
        .date-cell { font-size: 0.8rem; color: var(--muted); white-space: nowrap; }

        /* Book availability tag */
        .avail-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
            margin-top: 3px;
            white-space: nowrap;
        }

        .avail-yes { background: var(--teal-lt); color: var(--teal); }
        .avail-no  { background: var(--gold-lt);  color: #8a6115; }

        /* Status badges */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 3px 10px; border-radius: 20px;
        }

        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }

        .badge-pending   { background: var(--indigo-lt); color: var(--indigo); }
        .badge-pending   .badge-dot { background: var(--indigo); animation: pulse-indigo 2s infinite; }

        .badge-ready     { background: var(--teal-lt); color: var(--teal); }
        .badge-ready     .badge-dot { background: var(--teal); }

        .badge-cancelled { background: #f0eee9; color: var(--muted); }
        .badge-cancelled .badge-dot { background: var(--muted); }

        .badge-fulfilled { background: var(--gold-lt); color: #8a6115; }
        .badge-fulfilled .badge-dot { background: var(--gold); }

        /* Actions */
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
            font-family: 'DM Sans', sans-serif;
            transition: background 0.13s, color 0.13s, border-color 0.13s;
        }

        .action-view   { color: var(--teal);  border-color: #b0d8d2; }
        .action-cancel { color: var(--accent); border-color: #e8c4b8; }

        .action-view:hover   { background: var(--teal-lt); }
        .action-cancel:hover { background: var(--accent-lt); }

        .no-action { font-size: 0.72rem; color: var(--rule); }

        /* Empty state */
        .empty-state { text-align: center; padding: 3.5rem 1rem; }
        .empty-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.3; }
        .empty-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--muted); margin-bottom: 0.3rem; }
        .empty-sub { font-size: 0.8rem; color: var(--muted); opacity: 0.7; }

        .btn-empty {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 1rem;
            padding: 0.5rem 1.1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: #fff;
            background: var(--indigo);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.15s;
        }

        .btn-empty:hover { background: #2e3db8; }

        /* Pagination */
        .pagination-wrap {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--rule);
            background: #faf8f5;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
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
        <li>
            <a href="{{ route('loans.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                    <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                </svg>
                Borrow Records
            </a>
        </li>
        <li class="active">
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
            <h1 class="page-title">Book <span>Reservations</span></h1>
            <p class="page-subtitle">Manage pending, ready, and fulfilled reservation requests.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('books.index') }}" class="btn-outline">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                Browse Books
            </a>
            <a href="{{ route('reservations.create') }}" class="btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                New Reservation
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="flash">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Summary chips --}}
    <div class="summary-row">
        <div class="summary-chip chip-total">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $reservations->total() }}</span>
            <span class="chip-label">Total</span>
        </div>
        <div class="summary-chip chip-pending">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $pendingCount ?? $reservations->where('status', 'pending')->count() }}</span>
            <span class="chip-label">Pending</span>
        </div>
        <div class="summary-chip chip-ready">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $readyCount ?? $reservations->where('status', 'ready')->count() }}</span>
            <span class="chip-label">Ready</span>
        </div>
        <div class="summary-chip chip-cancelled">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $cancelledCount ?? $reservations->where('status', 'cancelled')->count() }}</span>
            <span class="chip-label">Cancelled</span>
        </div>
    </div>

    {{-- Table card --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Active Reservations</span>
            <span class="table-count">
                Showing <strong>{{ $reservations->count() }}</strong> of <strong>{{ $reservations->total() }}</strong>
            </span>
        </div>

        <div style="overflow-x: auto;">
            <table class="res-table">
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Reserved By</th>
                        <th>Reserved At</th>
                        <th>Book Status</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>

                            {{-- Book --}}
                            <td>
                                <div class="book-cell">
                                    @if($reservation->book->cover_image)
                                        <img src="{{ asset('storage/' . $reservation->book->cover_image) }}"
                                             alt="{{ $reservation->book->title }}"
                                             class="book-thumb" />
                                    @else
                                        <div class="book-thumb-placeholder">📕</div>
                                    @endif
                                    <div>
                                        <a href="{{ route('books.show', $reservation->book) }}" class="book-title-link">
                                            {{ $reservation->book->title }}
                                        </a>
                                        @if($reservation->book->author)
                                            <div class="book-author-small">{{ $reservation->book->author }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Reserved by --}}
                            <td>
                                <div class="reserver-cell">
                                    <div class="reserver-avatar">{{ strtoupper(substr($reservation->reserved_by, 0, 1)) }}</div>
                                    <span class="reserver-name">{{ $reservation->reserved_by }}</span>
                                </div>
                            </td>

                            {{-- Reserved at --}}
                            <td class="date-cell">
                                {{ optional($reservation->reserved_at)->format('M d, Y') ?? '—' }}
                                @if($reservation->reserved_at)
                                    <div style="font-size:0.68rem; color:var(--muted); margin-top:2px;">
                                        {{ optional($reservation->reserved_at)->diffForHumans() }}
                                    </div>
                                @endif
                            </td>

                            {{-- Book availability --}}
                            <td>
                                @if($reservation->book->available)
                                    <span class="avail-tag avail-yes">
                                        <svg width="7" height="7" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                        Available
                                    </span>
                                @else
                                    <span class="avail-tag avail-no">
                                        <svg width="7" height="7" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                        On Loan
                                    </span>
                                @endif
                            </td>

                            {{-- Reservation status --}}
                            <td>
                                @php $status = strtolower($reservation->status); @endphp
                                @if($status === 'pending')
                                    <span class="badge badge-pending">
                                        <span class="badge-dot"></span> Pending
                                    </span>
                                @elseif($status === 'ready')
                                    <span class="badge badge-ready">
                                        <span class="badge-dot"></span> Ready
                                    </span>
                                @elseif($status === 'cancelled')
                                    <span class="badge badge-cancelled">
                                        <span class="badge-dot"></span> Cancelled
                                    </span>
                                @else
                                    <span class="badge badge-fulfilled">
                                        <span class="badge-dot"></span> {{ ucfirst($status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="actions-cell">
                                <a href="{{ route('books.show', $reservation->book) }}" class="action-btn action-view">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    View
                                </a>
                                @if($reservation->status === 'pending')
                                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Cancel reservation for {{ addslashes($reservation->reserved_by) }}?');">
                                        @csrf
                                        <button type="submit" class="action-btn action-cancel">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="no-action">—</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">📅</div>
                                    <div class="empty-title">No reservations yet</div>
                                    <div class="empty-sub">Reservations allow borrowers to claim books in advance.</div>
                                    <a href="{{ route('reservations.create') }}" class="btn-empty">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                        Create First Reservation
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservations->hasPages())
            <div class="pagination-wrap">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>

</main>

</body>
</html>