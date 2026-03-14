<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — New Reservation</title>

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

        /* ── Form shell ───────────────────────────────── */
        .form-shell {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 1.5rem;
            align-items: start;
        }

        /* ── Cards ────────────────────────────────────── */
        .card {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--rule);
            background: #faf8f5;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .card-header-icon {
            width: 28px; height: 28px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
        }

        .card-header-icon.indigo { background: var(--indigo-lt); }
        .card-header-icon.amber  { background: var(--gold-lt); }
        .card-header-icon.teal   { background: var(--teal-lt); }

        .card-header-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--ink);
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }

        .card-body { padding: 1.5rem; }

        /* ── Fields ───────────────────────────────────── */
        .field { margin-bottom: 1.25rem; }
        .field:last-child { margin-bottom: 0; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .field-label .required { color: var(--accent); margin-left: 2px; }

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
            appearance: none;
            -webkit-appearance: none;
        }

        .field-input:focus {
            background: #fff;
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(59,79,216,0.1);
        }

        .field-input.has-error { border-color: var(--accent); background: #fff; }
        .field-input.has-error:focus { box-shadow: 0 0 0 3px rgba(181,69,27,0.12); }

        .field-hint { font-size: 0.7rem; color: var(--muted); margin-top: 0.35rem; line-height: 1.45; }

        .field-error {
            font-size: 0.72rem;
            color: var(--accent);
            font-weight: 500;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .field-row .field { margin-bottom: 0; }

        /* Select wrapper */
        .select-wrap { position: relative; }

        .select-wrap::after {
            content: '';
            position: absolute;
            right: 0.875rem; top: 50%;
            transform: translateY(-50%);
            width: 0; height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--muted);
            pointer-events: none;
        }

        /* ── Book preview card ────────────────────────── */
        .book-preview {
            background: var(--indigo-lt);
            border: 1px solid #c8cef5;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            margin-bottom: 1.25rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: none; } }

        .book-preview-thumb {
            width: 44px; height: 60px;
            border-radius: 5px;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 1px 2px 8px rgba(26,23,20,0.15);
        }

        .book-preview-placeholder {
            width: 44px; height: 60px;
            border-radius: 5px;
            background: rgba(59,79,216,0.1);
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }

        .book-preview-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--indigo);
            line-height: 1.3;
        }

        .book-preview-author { font-size: 0.74rem; color: #5c6bc0; margin-top: 2px; }

        .book-preview-avail {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 5px;
        }

        .avail-yes { background: var(--teal-lt); color: var(--teal); }
        .avail-no  { background: var(--gold-lt);  color: #8a6115; }

        /* ── Form actions ─────────────────────────────── */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--rule);
            background: #faf8f5;
        }

        .btn-cancel {
            padding: 0.55rem 1.2rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--muted);
            background: transparent;
            border: 1px solid var(--rule);
            border-radius: 8px;
            text-decoration: none;
            transition: border-color 0.15s, color 0.15s;
        }

        .btn-cancel:hover { border-color: var(--muted); color: var(--ink); }

        .btn-reserve {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.4rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #fff;
            background: var(--indigo);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-reserve:hover { background: #2e3db8; transform: translateY(-1px); }
        .btn-reserve:active { transform: translateY(0); }

        /* ── Info / Tips cards ────────────────────────── */
        .tips-list { list-style: none; }

        .tips-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            font-size: 0.78rem;
            color: var(--muted);
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--rule);
            line-height: 1.45;
        }

        .tips-list li:last-child { border-bottom: none; }
        .tips-icon { font-size: 0.85rem; flex-shrink: 0; margin-top: 1px; }

        /* Status note */
        .status-note {
            border-radius: 10px;
            padding: 1rem 1.25rem;
            font-size: 0.78rem;
            line-height: 1.55;
        }

        .status-note.warning {
            background: var(--gold-lt);
            border: 1px solid #e8d5a0;
            color: #7a5c10;
        }

        .status-note.info {
            background: var(--indigo-lt);
            border: 1px solid #c8cef5;
            color: #2d3bb0;
        }

        .status-note-title {
            font-weight: 700;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.3rem;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 960px) {
            .form-shell { grid-template-columns: 1fr; }
        }

        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
            .field-row { grid-template-columns: 1fr; }
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

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">New <span>Reservation</span></h1>
            <p class="page-subtitle">
                {{ $book ? 'Reserving "' . $book->title . '"' : 'Select a book and assign a borrower.' }}
            </p>
        </div>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span class="breadcrumb-sep">›</span>
            <a href="{{ route('reservations.index') }}">Reservations</a>
            <span class="breadcrumb-sep">›</span>
            <span class="breadcrumb-current">New</span>
        </nav>
    </div>

    <form method="POST" action="{{ route('reservations.store') }}" id="reservationForm">
        @csrf

        <div class="form-shell">

            {{-- ── Left: form fields ── --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon indigo">📅</div>
                    <span class="card-header-title">Reservation Details</span>
                </div>

                <div class="card-body">

                    {{-- Locked book preview --}}
                    @if($book)
                        <input type="hidden" name="book_id" value="{{ $book->id }}" />
                        <div class="book-preview">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}"
                                     alt="{{ $book->title }}"
                                     class="book-preview-thumb" />
                            @else
                                <div class="book-preview-placeholder">📕</div>
                            @endif
                            <div>
                                <div class="book-preview-title">{{ $book->title }}</div>
                                <div class="book-preview-author">{{ $book->author }}</div>
                                @if($book->available)
                                    <span class="book-preview-avail avail-yes">
                                        <svg width="6" height="6" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                        Available now
                                    </span>
                                @else
                                    <span class="book-preview-avail avail-no">
                                        <svg width="6" height="6" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                        Currently on loan
                                    </span>
                                @endif
                            </div>
                        </div>
                    @else
                        {{-- Book selector --}}
                        <div class="field">
                            <label class="field-label" for="book_id">
                                Book <span class="required">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="book_id" name="book_id"
                                        class="field-input {{ $errors->has('book_id') ? 'has-error' : '' }}"
                                        onchange="updateBookPreview(this)" required>
                                    <option value="">Choose a book…</option>
                                    @foreach($books as $optionBook)
                                        <option
                                            value="{{ $optionBook->id }}"
                                            data-title="{{ $optionBook->title }}"
                                            data-author="{{ $optionBook->author }}"
                                            data-available="{{ $optionBook->available ? '1' : '0' }}"
                                            @selected(old('book_id') == $optionBook->id)
                                        >
                                            {{ $optionBook->title }} — {{ $optionBook->author }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('book_id')
                                <div class="field-error">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- Dynamic book preview (populated via JS) --}}
                            <div id="dynamicPreview" style="display:none; margin-top:0.75rem;">
                                <div class="book-preview" style="margin-bottom:0;">
                                    <div class="book-preview-placeholder" id="previewIcon">📕</div>
                                    <div>
                                        <div class="book-preview-title" id="previewTitle">—</div>
                                        <div class="book-preview-author" id="previewAuthor">—</div>
                                        <span class="book-preview-avail" id="previewAvail"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reserved for --}}
                    <div class="field">
                        <label class="field-label" for="reserved_by">
                            Reserved For <span class="required">*</span>
                        </label>
                        <input
                            id="reserved_by" name="reserved_by" type="text"
                            class="field-input {{ $errors->has('reserved_by') ? 'has-error' : '' }}"
                            value="{{ old('reserved_by') }}"
                            placeholder="Full name of the person reserving"
                            required autofocus
                        />
                        @error('reserved_by')
                            <div class="field-error">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Dates row --}}
                    <div class="field-row">
                        <div class="field">
                            <label class="field-label" for="reserved_at">
                                Reserved Date
                            </label>
                            <input
                                id="reserved_at" name="reserved_at" type="date"
                                class="field-input {{ $errors->has('reserved_at') ? 'has-error' : '' }}"
                                value="{{ old('reserved_at', now()->toDateString()) }}"
                            />
                            @error('reserved_at')
                                <div class="field-error">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="field-label" for="expires_at">
                                Expires At
                            </label>
                            <input
                                id="expires_at" name="expires_at" type="date"
                                class="field-input {{ $errors->has('expires_at') ? 'has-error' : '' }}"
                                value="{{ old('expires_at') }}"
                                min="{{ now()->addDay()->toDateString() }}"
                            />
                            @error('expires_at')
                                <div class="field-error">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="field-hint">Optional. Leave blank for no expiry.</p>
                        </div>
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('reservations.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-reserve">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Reserve Book
                    </button>
                </div>
            </div>

            {{-- ── Right: context panels ── --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">

                {{-- Book status note --}}
                @if($book)
                    @if($book->available)
                        <div class="status-note info">
                            <div class="status-note-title">📗 Book is available</div>
                            This book is currently on the shelf. The reservation will hold it for the named borrower until the expiry date or until it is collected.
                        </div>
                    @else
                        <div class="status-note warning">
                            <div class="status-note-title">⏳ Book is currently on loan</div>
                            This book is already borrowed. The reservation will be queued and notified when it becomes available.
                        </div>
                    @endif
                @else
                    <div class="status-note info">
                        <div class="status-note-title">📋 No book pre-selected</div>
                        Choose a book from the dropdown. Its availability status will be shown automatically.
                    </div>
                @endif

                {{-- Tips --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon amber">💡</div>
                        <span class="card-header-title">Helpful Tips</span>
                    </div>
                    <div class="card-body" style="padding: 0.25rem 1.5rem;">
                        <ul class="tips-list">
                            <li>
                                <span class="tips-icon">📅</span>
                                The <strong>Reserved Date</strong> defaults to today but can be set to a future date.
                            </li>
                            <li>
                                <span class="tips-icon">⏰</span>
                                Setting an <strong>Expires At</strong> date automatically cancels the reservation if unclaimed.
                            </li>
                            <li>
                                <span class="tips-icon">🔔</span>
                                Reservations on borrowed books are queued — the borrower is notified when the book returns.
                            </li>
                            <li>
                                <span class="tips-icon">✏️</span>
                                You can cancel any pending reservation from the Reservations list at any time.
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Quick link to reservations list --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon teal">🔗</div>
                        <span class="card-header-title">Quick Links</span>
                    </div>
                    <div class="card-body" style="padding: 0.75rem 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="{{ route('reservations.index') }}" style="font-size:0.8rem; color:var(--indigo); text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.4rem;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            View All Reservations
                        </a>
                        <a href="{{ route('books.index') }}" style="font-size:0.8rem; color:var(--teal); text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.4rem;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                            Browse All Books
                        </a>
                        <a href="{{ route('loans.index') }}" style="font-size:0.8rem; color:var(--muted); text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.4rem;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/></svg>
                            Borrow Records
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>

</main>

<script>
    function updateBookPreview(select) {
        const preview  = document.getElementById('dynamicPreview');
        const title    = document.getElementById('previewTitle');
        const author   = document.getElementById('previewAuthor');
        const avail    = document.getElementById('previewAvail');

        if (!select.value) {
            preview.style.display = 'none';
            return;
        }

        const opt       = select.options[select.selectedIndex];
        const isAvail   = opt.dataset.available === '1';

        title.textContent  = opt.dataset.title  || '—';
        author.textContent = opt.dataset.author || '—';

        avail.className   = 'book-preview-avail ' + (isAvail ? 'avail-yes' : 'avail-no');
        avail.innerHTML   = `<svg width="6" height="6" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg> ${isAvail ? 'Available now' : 'Currently on loan'}`;

        preview.style.display = 'block';
    }

    // Restore preview on validation error (old value present)
    document.addEventListener('DOMContentLoaded', () => {
        const sel = document.getElementById('book_id');
        if (sel && sel.value) updateBookPreview(sel);
    });
</script>

</body>
</html>