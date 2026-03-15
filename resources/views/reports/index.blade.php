<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Reports & Analytics</title>

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
            margin-bottom: 2rem;
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

        /* ── Section layout ───────────────────────────── */
        .reports-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .full-width { grid-column: 1 / -1; }

        /* ── Card shell ───────────────────────────────── */
        .card {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--rule);
            background: #faf8f5;
        }

        .card-header-left { display: flex; align-items: center; gap: 0.6rem; }

        .card-header-icon {
            width: 28px; height: 28px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
        }

        .card-header-icon.gold   { background: var(--gold-lt); }
        .card-header-icon.red    { background: var(--accent-lt); }
        .card-header-icon.teal   { background: var(--teal-lt); }
        .card-header-icon.indigo { background: var(--indigo-lt); }

        .card-title {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--ink);
        }

        .card-count {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--muted);
        }

        /* ── Most Borrowed table ──────────────────────── */
        .report-table { width: 100%; border-collapse: collapse; }

        .report-table thead th {
            background: #faf8f5;
            font-size: 0.66rem;
            text-transform: uppercase;
            letter-spacing: 0.11em;
            color: var(--muted);
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--rule);
        }

        .report-table thead th:last-child { text-align: right; }

        .report-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
            animation: rowIn 0.25s ease both;
        }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-4px); }
            to   { opacity: 1; transform: none; }
        }

        .report-table tbody tr:nth-child(1)  { animation-delay: 0.04s; }
        .report-table tbody tr:nth-child(2)  { animation-delay: 0.08s; }
        .report-table tbody tr:nth-child(3)  { animation-delay: 0.12s; }
        .report-table tbody tr:nth-child(4)  { animation-delay: 0.16s; }
        .report-table tbody tr:nth-child(5)  { animation-delay: 0.20s; }

        .report-table tbody tr:last-child { border-bottom: none; }
        .report-table tbody tr:hover { background: #fdfcfa; }

        .report-table td {
            padding: 0.85rem 1.25rem;
            font-size: 0.83rem;
            vertical-align: middle;
        }

        /* Rank badge */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px; height: 22px;
            border-radius: 50%;
            font-size: 0.68rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .rank-1 { background: #fef3c7; color: #92400e; }
        .rank-2 { background: #f0f0f0; color: #4b5563; }
        .rank-3 { background: #fde8d8; color: #9a3412; }
        .rank-other { background: var(--rule); color: var(--muted); }

        .book-title-cell {
            font-family: 'Playfair Display', serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
        }

        .author-cell { color: var(--muted); font-size: 0.8rem; }

        /* Bar chart cell */
        .bar-cell { padding-right: 1.5rem !important; }

        .bar-wrap {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .bar-track {
            flex: 1;
            height: 8px;
            background: var(--rule);
            border-radius: 4px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .bar-gold   { background: var(--gold); }
        .bar-red    { background: var(--accent); }
        .bar-teal   { background: var(--teal); }
        .bar-indigo { background: var(--indigo); }

        .bar-count {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--ink);
            min-width: 20px;
            text-align: right;
        }

        /* Borrower cell */
        .borrower-cell { display: flex; align-items: center; gap: 0.6rem; }

        .borrower-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--accent-lt);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.68rem; font-weight: 700;
            color: var(--accent);
            flex-shrink: 0;
        }

        .borrower-name { font-weight: 600; font-size: 0.84rem; }

        /* Genre pill */
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
        }

        /* Empty state */
        .empty-state { text-align: center; padding: 2.5rem 1rem; color: var(--muted); font-size: 0.8rem; }

        /* ── Genre donut (CSS-only arc approximation) ─── */
        .genre-chart-wrap {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            padding: 1.25rem 1.5rem;
        }

        .donut-wrap {
            position: relative;
            width: 120px; height: 120px;
            flex-shrink: 0;
        }

        .donut-svg { width: 120px; height: 120px; transform: rotate(-90deg); }

        .donut-bg {
            fill: none;
            stroke: var(--rule);
            stroke-width: 14;
        }

        .donut-seg {
            fill: none;
            stroke-width: 14;
            stroke-linecap: butt;
            transition: stroke-dashoffset 0.8s cubic-bezier(0.34, 1.2, 0.64, 1);
        }

        .donut-label {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .donut-total {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .donut-sub { font-size: 0.6rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; margin-top: 2px; }

        .genre-legend { flex: 1; display: flex; flex-direction: column; gap: 0.4rem; }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
        }

        .legend-dot {
            width: 9px; height: 9px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-name { flex: 1; color: var(--ink); font-weight: 500; }
        .legend-pct  { font-weight: 700; color: var(--muted); font-size: 0.72rem; }
        .legend-count { font-weight: 700; color: var(--ink); min-width: 20px; text-align: right; font-size: 0.75rem; }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 1000px) {
            .reports-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: 1; }
        }

        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
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
        <li class="active">
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

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Reports & <span>Analytics</span></h1>
            <p class="page-subtitle">An overview of borrowing trends, overdue accounts, and collection composition.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-outline">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Dashboard
        </a>
    </div>

    {{-- ── Two-column grid ── --}}
    <div class="reports-grid">

        {{-- ── Most Borrowed Books ── --}}
        <div class="card full-width">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon gold">🏆</div>
                    <span class="card-title">Most Borrowed Books</span>
                </div>
                <span class="card-count">{{ $mostBorrowed->count() }} titles</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th style="width:220px;">Borrow Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mostBorrowed as $i => $row)
                            @php $max = $mostBorrowed->max('total') ?: 1; @endphp
                            <tr>
                                <td>
                                    <span class="rank-badge {{ $i === 0 ? 'rank-1' : ($i === 1 ? 'rank-2' : ($i === 2 ? 'rank-3' : 'rank-other')) }}">
                                        {{ $i + 1 }}
                                    </span>
                                </td>
                                <td class="book-title-cell">{{ $row->book?->title ?? '—' }}</td>
                                <td class="author-cell">{{ $row->book?->author ?? '—' }}</td>
                                <td class="bar-cell">
                                    <div class="bar-wrap">
                                        <div class="bar-track">
                                            <div class="bar-fill bar-gold"
                                                 style="width: {{ round(($row->total / $max) * 100) }}%">
                                            </div>
                                        </div>
                                        <span class="bar-count">{{ $row->total }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><div class="empty-state">No borrow data yet.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── Overdue by Borrower ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon red">⚠️</div>
                    <span class="card-title">Overdue by Borrower</span>
                </div>
                <span class="card-count" style="color:var(--accent);">{{ $overdueByBorrower->sum('total') }} overdue</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th style="width:180px;">Overdue Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($overdueByBorrower as $row)
                            @php $maxO = $overdueByBorrower->max('total') ?: 1; @endphp
                            <tr>
                                <td>
                                    <div class="borrower-cell">
                                        <div class="borrower-avatar">{{ strtoupper(substr($row->borrower_name, 0, 1)) }}</div>
                                        <span class="borrower-name">{{ $row->borrower_name }}</span>
                                    </div>
                                </td>
                                <td class="bar-cell">
                                    <div class="bar-wrap">
                                        <div class="bar-track">
                                            <div class="bar-fill bar-red"
                                                 style="width: {{ round(($row->total / $maxO) * 100) }}%">
                                            </div>
                                        </div>
                                        <span class="bar-count" style="color:var(--accent);">{{ $row->total }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2"><div class="empty-state">🎉 No overdue loans!</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── Books by Genre ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon teal">📚</div>
                    <span class="card-title">Collection by Genre</span>
                </div>
                <span class="card-count">{{ $stockByGenre->sum('total') }} books</span>
            </div>

            @php
                $totalBooks = $stockByGenre->sum('total') ?: 1;
                $palette = [
                    '#1d6b5e', '#c9973a', '#3b4fd8', '#b5451b',
                    '#5b8dd9', '#6b9e6b', '#9b6b9e', '#c97a3a',
                ];
                $circumference = 2 * M_PI * 44; // r=44
                $offset = 0;
                $segments = [];
                foreach ($stockByGenre as $idx => $row) {
                    $pct = $row->total / $totalBooks;
                    $segments[] = [
                        'color'  => $palette[$idx % count($palette)],
                        'dash'   => $pct * $circumference,
                        'offset' => $offset,
                        'label'  => $row->genre,
                        'total'  => $row->total,
                        'pct'    => round($pct * 100),
                    ];
                    $offset += $pct * $circumference;
                }
            @endphp

            @if($stockByGenre->isEmpty())
                <div class="empty-state">No books available.</div>
            @else
                <div class="genre-chart-wrap">
                    {{-- Donut --}}
                    <div class="donut-wrap">
                        <svg class="donut-svg" viewBox="0 0 100 100">
                            <circle class="donut-bg" cx="50" cy="50" r="44" />
                            @foreach($segments as $seg)
                                <circle
                                    class="donut-seg"
                                    cx="50" cy="50" r="44"
                                    stroke="{{ $seg['color'] }}"
                                    stroke-dasharray="{{ $seg['dash'] }} {{ $circumference - $seg['dash'] }}"
                                    stroke-dashoffset="{{ -$seg['offset'] }}"
                                />
                            @endforeach
                        </svg>
                        <div class="donut-label">
                            <span class="donut-total">{{ $stockByGenre->sum('total') }}</span>
                            <span class="donut-sub">books</span>
                        </div>
                    </div>

                    {{-- Legend --}}
                    <div class="genre-legend">
                        @foreach($segments as $seg)
                            <div class="legend-item">
                                <span class="legend-dot" style="background: {{ $seg['color'] }};"></span>
                                <span class="legend-name">{{ $seg['label'] }}</span>
                                <span class="legend-pct">{{ $seg['pct'] }}%</span>
                                <span class="legend-count">{{ $seg['total'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Genre bar table --}}
                <div style="border-top: 1px solid var(--rule); overflow-x:auto;">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Genre</th>
                                <th style="width:220px;">Share</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($segments as $i => $seg)
                                <tr>
                                    <td><span class="genre-pill">{{ $seg['label'] }}</span></td>
                                    <td class="bar-cell">
                                        <div class="bar-wrap">
                                            <div class="bar-track">
                                                <div class="bar-fill"
                                                     style="background:{{ $seg['color'] }}; width:{{ $seg['pct'] }}%">
                                                </div>
                                            </div>
                                            <span class="bar-count">{{ $seg['total'] }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>{{-- end reports-grid --}}

</main>

</body>
</html>