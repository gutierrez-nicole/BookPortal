<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — {{ $book->title }}</title>

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

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: var(--muted);
        }

        .breadcrumb a { color: var(--muted); text-decoration: none; }
        .breadcrumb a:hover { color: var(--ink); }
        .breadcrumb-sep { opacity: 0.4; }
        .breadcrumb-current { color: var(--ink); font-weight: 600; }

        /* ── Header action buttons ────────────────────── */
        .header-actions { display: flex; gap: 0.6rem; }

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
            cursor: pointer;
        }

        .btn-outline:hover { border-color: var(--muted); color: var(--ink); }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.5rem 1.1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            color: #fff;
            background: var(--ink);
            transition: background 0.15s, transform 0.1s;
        }

        .btn-edit:hover { background: #2e2a27; transform: translateY(-1px); }

        /* ── Main content grid ───────────────────────── */
        .content-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 2rem;
            align-items: start;
        }

        /* ── Cover column ─────────────────────────────── */
        .cover-col { display: flex; flex-direction: column; gap: 1rem; }

        .book-cover-wrap {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(26,23,20,0.18), 4px 4px 0 var(--rule);
        }

        .book-cover-wrap img {
            width: 100%;
            display: block;
            aspect-ratio: 2/3;
            object-fit: cover;
        }

        .book-cover-no-image {
            width: 100%;
            aspect-ratio: 2/3;
            background: linear-gradient(145deg, #ede9e2, #ddd7cc);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(26,23,20,0.12), 4px 4px 0 var(--rule);
        }

        .book-cover-no-image span { font-size: 3rem; opacity: 0.3; }
        .book-cover-no-image p { font-size: 0.72rem; color: var(--muted); opacity: 0.6; }

        /* QR card */
        .qr-card {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }

        .qr-label {
            font-size: 0.67rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.75rem;
        }

        .qr-img {
            width: 100%;
            max-width: 140px;
            height: auto;
            border-radius: 6px;
            display: block;
            margin: 0 auto;
        }

        .qr-hint {
            font-size: 0.67rem;
            color: var(--muted);
            margin-top: 0.6rem;
            line-height: 1.4;
        }

        /* ── Detail column ────────────────────────────── */
        .detail-col { display: flex; flex-direction: column; gap: 1.25rem; }

        /* Book hero */
        .book-hero {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            padding: 1.75rem 2rem;
        }

        .book-hero-genre {
            font-size: 0.67rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }

        .book-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: var(--ink);
        }

        .book-hero-author {
            font-size: 0.9rem;
            color: var(--muted);
            margin-top: 0.4rem;
        }

        .book-hero-author em { font-style: italic; }

        .book-hero-divider {
            height: 1px;
            background: var(--rule);
            margin: 1.25rem 0;
        }

        .book-meta-row {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .book-meta-item { }

        .book-meta-key {
            font-size: 0.66rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.2rem;
        }

        .book-meta-val {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--ink);
        }

        .status-available {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 4px 12px; border-radius: 20px;
            background: var(--teal-lt); color: var(--teal);
        }

        .status-borrowed {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 4px 12px; border-radius: 20px;
            background: var(--gold-lt); color: #8a6115;
        }

        .status-dot {
            width: 7px; height: 7px; border-radius: 50%;
        }

        .status-available .status-dot { background: var(--teal); animation: pulse-teal 2s infinite; }
        .status-borrowed  .status-dot { background: var(--gold); }

        @keyframes pulse-teal {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }

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
            gap: 0.6rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--rule);
            background: #faf8f5;
        }

        .card-header-icon {
            width: 26px; height: 26px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
        }

        .card-header-icon.teal   { background: var(--teal-lt); }
        .card-header-icon.gold   { background: var(--gold-lt); }
        .card-header-icon.indigo { background: var(--indigo-lt); }
        .card-header-icon.amber  { background: var(--gold-lt); }

        .card-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--ink);
        }

        .card-body { padding: 1.5rem; }

        /* ── Borrow form ──────────────────────────────── */
        .borrow-form { display: flex; flex-direction: column; gap: 1rem; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .field-input {
            width: 100%;
            height: 40px;
            padding: 0 0.875rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--ink);
            background: var(--cream);
            border: 1px solid var(--rule);
            border-radius: 9px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        }

        .field-input:focus {
            background: #fff;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,151,58,0.13);
        }

        .field-error {
            font-size: 0.72rem;
            color: var(--accent);
            font-weight: 500;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .borrow-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-borrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.4rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #fff;
            background: var(--teal);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            align-self: flex-end;
        }

        .btn-borrow:hover { background: #165a4e; transform: translateY(-1px); }

        /* ── Borrowed state ───────────────────────────── */
        .borrowed-banner {
            background: var(--gold-lt);
            border: 1px solid #e8d5a0;
            border-radius: 10px;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        .borrowed-banner-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: #7a5c10;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 0.6rem;
        }

        .borrowed-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .borrowed-detail-item { }

        .borrowed-detail-key {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a07828;
        }

        .borrowed-detail-val {
            font-size: 0.875rem;
            font-weight: 600;
            color: #5a3d08;
            margin-top: 0.15rem;
        }

        .overdue-flag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 8px;
            border-radius: 20px;
            background: var(--accent-lt);
            color: var(--accent);
            margin-left: 0.4rem;
        }

        .btn-return {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #fff;
            background: var(--accent);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-return:hover { background: #9b3a15; transform: translateY(-1px); }

        /* ── Reserve card ─────────────────────────────── */
        .reserve-body {
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
        }

        .reserve-icon-wrap {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--indigo-lt);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .reserve-text { flex: 1; }

        .reserve-text p {
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 0.75rem;
        }

        .btn-reserve {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #fff;
            background: var(--indigo);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-reserve:hover { background: #2e3db8; transform: translateY(-1px); }

        /* ── Loan history table ───────────────────────── */
        .loan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
        }

        .loan-table thead th {
            background: #faf8f5;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            font-weight: 700;
            padding: 0.65rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--rule);
        }

        .loan-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
        }

        .loan-table tbody tr:last-child { border-bottom: none; }
        .loan-table tbody tr:hover { background: #fdfcfa; }

        .loan-table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }

        .borrower-avatar {
            width: 26px; height: 26px;
            border-radius: 50%;
            background: var(--rule);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.65rem; font-weight: 700; color: var(--muted);
            margin-right: 0.5rem;
            vertical-align: middle;
        }

        .loan-returned {
            font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 2px 8px; border-radius: 20px;
            background: var(--teal-lt); color: var(--teal);
        }

        .loan-overdue {
            font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 2px 8px; border-radius: 20px;
            background: var(--accent-lt); color: var(--accent);
        }

        .loan-active {
            font-size: 0.67rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 2px 8px; border-radius: 20px;
            background: var(--gold-lt); color: #8a6115;
        }

        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--muted);
            font-size: 0.8rem;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 1024px) {
            .content-grid { grid-template-columns: 200px 1fr; }
        }

        @media (max-width: 768px) {
            .content-grid { grid-template-columns: 1fr; }
            .borrow-form-row { grid-template-columns: 1fr; }
            .borrowed-detail-grid { grid-template-columns: 1fr; }
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
     MAIN
═══════════════════════════════════════════ --}}
<main class="main">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Book <span>Details</span></h1>
            <p class="page-subtitle">Viewing record for <em>{{ $book->title }}</em>.</p>
        </div>
        <div style="display:flex; flex-direction:column; align-items:flex-end; gap:0.75rem;">
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <span class="breadcrumb-sep">›</span>
                <a href="{{ route('books.index') }}">Books</a>
                <span class="breadcrumb-sep">›</span>
                <span class="breadcrumb-current">{{ Str::limit($book->title, 28) }}</span>
            </nav>
            <div class="header-actions">
                <a href="{{ route('books.index') }}" class="btn-outline">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back
                </a>
                <a href="{{ route('books.edit', $book) }}" class="btn-edit">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Book
                </a>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="content-grid">

        {{-- ── Left: cover + QR ── --}}
        <div class="cover-col">
            {{-- Cover --}}
            <div class="book-cover-wrap">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" />
                @else
                    <div class="book-cover-no-image">
                        <span>📕</span>
                        <p>No cover</p>
                    </div>
                @endif
            </div>

            {{-- QR Code --}}
            <div class="qr-card">
                <div class="qr-label">Book QR Code</div>
                <img
                    src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ urlencode(route('books.show', $book)) }}&choe=UTF-8"
                    alt="QR code for {{ $book->title }}"
                    class="qr-img"
                />
                <p class="qr-hint">Scan to open this record in BookPortal.</p>
            </div>
        </div>

        {{-- ── Right: details + actions ── --}}
        <div class="detail-col">

            {{-- Book hero --}}
            <div class="book-hero">
                @if($book->genre)
                    <div class="book-hero-genre">{{ $book->genre }}</div>
                @endif
                <h2 class="book-hero-title">{{ $book->title }}</h2>
                <p class="book-hero-author">by <em>{{ $book->author }}</em></p>

                <div class="book-hero-divider"></div>

                <div class="book-meta-row">
                    <div class="book-meta-item">
                        <div class="book-meta-key">Status</div>
                        <div class="book-meta-val">
                            @if($book->available)
                                <span class="status-available">
                                    <span class="status-dot"></span> Available
                                </span>
                            @else
                                <span class="status-borrowed">
                                    <span class="status-dot"></span> Borrowed
                                </span>
                            @endif
                        </div>
                    </div>
                    @if($book->isbn)
                        <div class="book-meta-item">
                            <div class="book-meta-key">ISBN</div>
                            <div class="book-meta-val" style="font-size:0.8rem; font-family: monospace;">{{ $book->isbn }}</div>
                        </div>
                    @endif
                    <div class="book-meta-item">
                        <div class="book-meta-key">Added</div>
                        <div class="book-meta-val" style="font-size:0.8rem;">{{ $book->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="book-meta-item">
                        <div class="book-meta-key">Book ID</div>
                        <div class="book-meta-val" style="font-size:0.8rem;">#{{ $book->id }}</div>
                    </div>
                </div>
            </div>

            {{-- Borrow / Return card --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon {{ $book->available ? 'teal' : 'gold' }}">
                        {{ $book->available ? '📖' : '⏳' }}
                    </div>
                    <span class="card-title">
                        {{ $book->available ? 'Lend This Book' : 'Currently Borrowed' }}
                    </span>
                </div>
                <div class="card-body">

                    @if($book->available)
                        {{-- Borrow form --}}
                        <form method="POST" action="{{ route('books.borrow', $book) }}" class="borrow-form">
                            @csrf
                            <div class="borrow-form-row">
                                <div>
                                    <label class="field-label" for="borrower_name">Borrower Name <span style="color:var(--accent)">*</span></label>
                                    <input
                                        id="borrower_name" name="borrower_name" type="text"
                                        class="field-input"
                                        value="{{ old('borrower_name') }}"
                                        placeholder="Full name of borrower"
                                        required
                                    />
                                    @error('borrower_name')
                                        <div class="field-error">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="field-label" for="due_date">Due Date <span style="color:var(--accent)">*</span></label>
                                    <input
                                        id="due_date" name="due_date" type="date"
                                        class="field-input"
                                        value="{{ old('due_date') }}"
                                        min="{{ now()->addDay()->toDateString() }}"
                                        required
                                    />
                                    @error('due_date')
                                        <div class="field-error">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div style="display:flex; justify-content:flex-end;">
                                <button type="submit" class="btn-borrow">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                                    Borrow Book
                                </button>
                            </div>
                        </form>

                    @else
                        {{-- Borrowed state --}}
                        @if($book->currentLoan())
                            @php $loan = $book->currentLoan(); @endphp
                            <div class="borrowed-banner">
                                <div class="borrowed-banner-title">Active Loan</div>
                                <div class="borrowed-detail-grid">
                                    <div class="borrowed-detail-item">
                                        <div class="borrowed-detail-key">Borrower</div>
                                        <div class="borrowed-detail-val">{{ $loan->borrower_name }}</div>
                                    </div>
                                    <div class="borrowed-detail-item">
                                        <div class="borrowed-detail-key">Due Date</div>
                                        <div class="borrowed-detail-val">
                                            {{ $loan->due_date->format('M d, Y') }}
                                            @if($loan->due_date->isPast())
                                                <span class="overdue-flag">Overdue</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="borrowed-detail-item">
                                        <div class="borrowed-detail-key">Borrowed On</div>
                                        <div class="borrowed-detail-val">{{ $loan->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <div class="borrowed-detail-item">
                                        <div class="borrowed-detail-key">Days Remaining</div>
                                        <div class="borrowed-detail-val">
                                            @if($loan->due_date->isPast())
                                                {{ $loan->due_date->diffInDays(now()) }} days overdue
                                            @else
                                                {{ now()->diffInDays($loan->due_date) }} days left
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('books.return', $book) }}" style="display:flex; justify-content:flex-end;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-return">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Mark as Returned
                            </button>
                        </form>
                    @endif

                </div>
            </div>

            {{-- Reserve card --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon indigo">📅</div>
                    <span class="card-title">Reserve This Book</span>
                </div>
                <div class="card-body">
                    <div class="reserve-body">
                        <div class="reserve-icon-wrap">📋</div>
                        <div class="reserve-text">
                            <p>Create a reservation so a borrower can claim this book at a later date — even if it's currently on loan.</p>
                            <a href="{{ route('reservations.create', ['book' => $book->id]) }}" class="btn-reserve">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                Reserve
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Loan history --}}
            @if(isset($loanHistory) && $loanHistory->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon amber">🕓</div>
                        <span class="card-title">Loan History</span>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="loan-table">
                            <thead>
                                <tr>
                                    <th>Borrower</th>
                                    <th>Borrowed</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loanHistory as $record)
                                    <tr>
                                        <td>
                                            <span class="borrower-avatar">{{ strtoupper(substr($record->borrower_name, 0, 1)) }}</span>
                                            {{ $record->borrower_name }}
                                        </td>
                                        <td style="color:var(--muted); font-size:0.79rem;">{{ $record->created_at->format('M d, Y') }}</td>
                                        <td style="font-size:0.79rem;">{{ $record->due_date->format('M d, Y') }}</td>
                                        <td>
                                            @if($record->returned_at)
                                                <span class="loan-returned">Returned</span>
                                            @elseif($record->due_date->isPast())
                                                <span class="loan-overdue">Overdue</span>
                                            @else
                                                <span class="loan-active">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>

</main>

</body>
</html>