<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Edit Book</title>

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

        .card-header-icon.amber { background: var(--gold-lt); }
        .card-header-icon.teal  { background: var(--teal-lt); }
        .card-header-icon.red   { background: var(--accent-lt); }

        .card-header-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--ink);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            flex: 1;
        }

        .card-header-meta {
            font-size: 0.7rem;
            color: var(--muted);
            font-style: italic;
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
        }

        .field-input:focus {
            background: #fff;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,151,58,0.13);
        }

        .field-input.has-error { border-color: var(--accent); background: #fff; }
        .field-input.has-error:focus { box-shadow: 0 0 0 3px rgba(181,69,27,0.12); }

        .field-hint { font-size: 0.7rem; color: var(--muted); margin-top: 0.35rem; }

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

        /* ── Cover panel ──────────────────────────────── */
        .cover-current {
            position: relative;
            margin-bottom: 1rem;
        }

        .cover-current-img {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            box-shadow: 0 4px 20px rgba(26,23,20,0.14);
        }

        .cover-current-label {
            position: absolute;
            bottom: 8px; left: 8px;
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: rgba(26,23,20,0.7);
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            backdrop-filter: blur(4px);
        }

        .cover-replace-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
            display: block;
        }

        .cover-upload-zone {
            border: 2px dashed var(--rule);
            border-radius: 10px;
            padding: 1.1rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }

        .cover-upload-zone:hover,
        .cover-upload-zone.drag-over {
            border-color: var(--gold);
            background: var(--gold-lt);
        }

        .cover-upload-zone.has-new-file {
            border-color: var(--teal);
            background: var(--teal-lt);
        }

        .cover-upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .cover-new-preview {
            width: 70px;
            height: 95px;
            object-fit: cover;
            border-radius: 5px;
            margin: 0 auto 0.5rem;
            display: none;
            box-shadow: 0 3px 12px rgba(26,23,20,0.15);
        }

        .upload-icon { font-size: 1.5rem; opacity: 0.25; margin-bottom: 0.3rem; }

        .cover-upload-text {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--ink);
            display: block;
            margin-bottom: 0.15rem;
        }

        .cover-upload-sub { font-size: 0.67rem; color: var(--muted); }

        .cover-new-filename {
            font-size: 0.68rem;
            color: var(--teal);
            font-weight: 600;
            margin-top: 0.4rem;
            display: none;
        }

        /* No cover placeholder */
        .cover-no-image {
            width: 100%;
            aspect-ratio: 3/4;
            background: var(--rule);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .cover-no-image span { font-size: 2rem; }
        .cover-no-image p { font-size: 0.72rem; color: var(--muted); }

        /* ── Metadata panel ───────────────────────────── */
        .meta-list { list-style: none; }

        .meta-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px solid var(--rule);
            font-size: 0.78rem;
        }

        .meta-item:last-child { border-bottom: none; }

        .meta-key {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
        }

        .meta-val { font-weight: 500; color: var(--ink); text-align: right; }

        .status-available {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 3px 10px; border-radius: 20px;
            background: var(--teal-lt); color: var(--teal);
        }

        .status-borrowed {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 3px 10px; border-radius: 20px;
            background: var(--gold-lt); color: #8a6115;
        }

        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
        .status-available .status-dot { background: var(--teal); }
        .status-borrowed  .status-dot { background: var(--gold); }

        /* ── Danger zone ──────────────────────────────── */
        .danger-zone {
            border: 1px solid #f3c4b4;
            border-radius: 14px;
            overflow: hidden;
        }

        .danger-zone .card-header { background: var(--accent-lt); }

        .danger-body {
            padding: 1.25rem 1.5rem;
            background: #fff;
        }

        .danger-body p {
            font-size: 0.78rem;
            color: var(--muted);
            margin-bottom: 1rem;
            line-height: 1.55;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: var(--accent);
            background: transparent;
            border: 1.5px solid var(--accent);
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .btn-danger:hover { background: var(--accent); color: #fff; }

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

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.4rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #fff;
            background: var(--accent);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-save:hover { background: #9b3a15; transform: translateY(-1px); }
        .btn-save:active { transform: translateY(0); }

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
            <h1 class="page-title">Edit <span>Book</span></h1>
            <p class="page-subtitle">Update the details for <strong>{{ $book->title }}</strong>.</p>
        </div>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span class="breadcrumb-sep">›</span>
            <a href="{{ route('books.index') }}">Books</a>
            <span class="breadcrumb-sep">›</span>
            <a href="{{ route('books.show', $book) }}">{{ Str::limit($book->title, 24) }}</a>
            <span class="breadcrumb-sep">›</span>
            <span class="breadcrumb-current">Edit</span>
        </nav>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" id="editBookForm">
        @csrf
        @method('PUT')

        <div class="form-shell">

            {{-- ── Left: fields ── --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon amber">✏️</div>
                    <span class="card-header-title">Book Details</span>
                    <span class="card-header-meta">ID #{{ $book->id }}</span>
                </div>

                <div class="card-body">

                    {{-- Title --}}
                    <div class="field">
                        <label class="field-label" for="title">
                            Title <span class="required">*</span>
                        </label>
                        <input
                            id="title" name="title" type="text"
                            class="field-input {{ $errors->has('title') ? 'has-error' : '' }}"
                            value="{{ old('title', $book->title) }}"
                            placeholder="Full book title"
                            required autofocus
                        />
                        @error('title')
                            <div class="field-error">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div class="field">
                        <label class="field-label" for="author">
                            Author <span class="required">*</span>
                        </label>
                        <input
                            id="author" name="author" type="text"
                            class="field-input {{ $errors->has('author') ? 'has-error' : '' }}"
                            value="{{ old('author', $book->author) }}"
                            placeholder="Author full name"
                            required
                        />
                        @error('author')
                            <div class="field-error">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Genre + ISBN --}}
                    <div class="field-row">
                        <div class="field">
                            <label class="field-label" for="genre">
                                Genre <span class="required">*</span>
                            </label>
                            <input
                                id="genre" name="genre" type="text"
                                class="field-input {{ $errors->has('genre') ? 'has-error' : '' }}"
                                value="{{ old('genre', $book->genre) }}"
                                placeholder="e.g. Fiction"
                                required
                            />
                            @error('genre')
                                <div class="field-error">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="field-label" for="isbn">
                                ISBN <span class="required">*</span>
                            </label>
                            <input
                                id="isbn" name="isbn" type="text"
                                class="field-input {{ $errors->has('isbn') ? 'has-error' : '' }}"
                                value="{{ old('isbn', $book->isbn) }}"
                                placeholder="978-x-xxx-xxxxx-x"
                                required
                            />
                            @error('isbn')
                                <div class="field-error">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('books.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Update Book
                    </button>
                </div>
            </div>

            {{-- ── Right column ── --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">

                {{-- Cover image --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon teal">🖼️</div>
                        <span class="card-header-title">Cover Image</span>
                    </div>
                    <div class="card-body">

                        {{-- Current cover --}}
                        @if($book->cover_image)
                            <div class="cover-current">
                                <img
                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                    alt="{{ $book->title }}"
                                    class="cover-current-img"
                                    id="currentCover"
                                />
                                <span class="cover-current-label">Current cover</span>
                            </div>
                            <span class="cover-replace-label">Replace with new image</span>
                        @else
                            <div class="cover-no-image">
                                <span>📕</span>
                                <p>No cover image</p>
                            </div>
                            <span class="cover-replace-label">Upload a cover image</span>
                        @endif

                        {{-- Upload zone --}}
                        <div class="cover-upload-zone" id="uploadZone">
                            <input
                                type="file"
                                name="cover_image"
                                id="cover_image"
                                accept="image/*"
                                onchange="previewCover(this)"
                            />
                            <img id="coverNewPreview" class="cover-new-preview" src="" alt="New cover preview" />
                            <div id="uploadPrompt">
                                <div class="upload-icon">📸</div>
                                <span class="cover-upload-text">Drop new image here</span>
                                <span class="cover-upload-sub">or click to browse — JPG, PNG, WebP</span>
                            </div>
                            <div class="cover-new-filename" id="coverFilename"></div>
                        </div>

                        @error('cover_image')
                            <div class="field-error" style="margin-top:0.5rem;">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror

                        <p class="field-hint" style="margin-top: 0.6rem;">
                            Leaving this empty keeps the existing cover.
                        </p>
                    </div>
                </div>

                {{-- Book metadata --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-icon amber">📋</div>
                        <span class="card-header-title">Record Info</span>
                    </div>
                    <div class="card-body" style="padding: 0.25rem 1.5rem;">
                        <ul class="meta-list">
                            <li class="meta-item">
                                <span class="meta-key">Status</span>
                                <span class="meta-val">
                                    @if($book->available)
                                        <span class="status-available"><span class="status-dot"></span> Available</span>
                                    @else
                                        <span class="status-borrowed"><span class="status-dot"></span> Borrowed</span>
                                    @endif
                                </span>
                            </li>
                            <li class="meta-item">
                                <span class="meta-key">Added</span>
                                <span class="meta-val">{{ $book->created_at->format('M d, Y') }}</span>
                            </li>
                            <li class="meta-item">
                                <span class="meta-key">Last Updated</span>
                                <span class="meta-val">{{ $book->updated_at->format('M d, Y') }}</span>
                            </li>
                            <li class="meta-item">
                                <span class="meta-key">Book ID</span>
                                <span class="meta-val">#{{ $book->id }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </form>

    {{-- Danger zone --}}
    <div class="danger-zone">
        <div class="card-header">
            <div class="card-header-icon red">⚠️</div>
            <span class="card-header-title" style="color: var(--accent);">Danger Zone</span>
        </div>
        <div class="danger-body">
            <p>Permanently deleting this book cannot be undone. All associated loan and reservation records may be affected.</p>
            <form action="{{ route('books.destroy', $book) }}" method="POST"
                  onsubmit="return confirm('Permanently delete \'{{ addslashes($book->title) }}\'? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                    Delete This Book
                </button>
            </form>
        </div>
    </div>

</main>

<script>
    function previewCover(input) {
        const newPreview  = document.getElementById('coverNewPreview');
        const prompt      = document.getElementById('uploadPrompt');
        const filename    = document.getElementById('coverFilename');
        const zone        = document.getElementById('uploadZone');
        const currentCover = document.getElementById('currentCover');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = e => {
                newPreview.src = e.target.result;
                newPreview.style.display = 'block';
                prompt.style.display = 'none';
                filename.style.display = 'block';
                filename.textContent = '→ ' + file.name;
                zone.classList.add('has-new-file');

                // Fade out current cover if present
                if (currentCover) {
                    currentCover.style.transition = 'opacity 0.3s';
                    currentCover.style.opacity = '0.35';
                }
            };

            reader.readAsDataURL(file);
        }
    }

    const zone = document.getElementById('uploadZone');
    zone.addEventListener('dragover',  () => zone.classList.add('drag-over'));
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop',      () => zone.classList.remove('drag-over'));
</script>

</body>
</html>