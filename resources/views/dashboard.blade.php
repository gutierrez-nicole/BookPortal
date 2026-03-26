<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>BookPortal — Dashboard</title>

    {{-- Google Fonts: Playfair Display + DM Sans --}}
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

        .sidebar-brand-name em {
            font-style: italic;
            color: var(--gold);
        }

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

        .sidebar-nav {
            list-style: none;
            padding: 0 0.75rem;
        }

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
            width: 18px;
            height: 18px;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .sidebar-nav li.active a .nav-icon { opacity: 1; }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem 1.75rem 0;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--ink);
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.8);
        }
        .sidebar-user-role {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.3);
        }

        .sidebar-logout {
            margin-top: 0.85rem;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.3);
            background: transparent;
            border: 1px solid rgba(255,255,255,0.07);
            cursor: pointer;
            text-align: left;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            letter-spacing: 0.02em;
        }

        .sidebar-logout:hover {
            background: rgba(181,69,27,0.15);
            color: #e8a090;
            border-color: rgba(181,69,27,0.25);
        }

        .sidebar-logout svg { opacity: 0.6; flex-shrink: 0; transition: opacity 0.15s; }
        .sidebar-logout:hover svg { opacity: 1; }

        /* ── Main content ─────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            padding: 2.5rem 2.5rem 4rem;
        }

        /* ── Page header ──────────────────────────────── */
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
            color: var(--ink);
            line-height: 1;
        }

        .page-title span {
            font-style: italic;
            color: var(--muted);
        }

        .page-subtitle {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 0.4rem;
            font-weight: 400;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-date {
            font-size: 0.75rem;
            color: var(--muted);
            text-align: right;
        }

        /* ── Notification Bell ────────────────────────── */
        .notification-btn {
            position: relative;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 12px;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.15s;
        }

        .notification-btn:hover {
            background: var(--cream);
            border-color: var(--gold);
            color: var(--ink);
        }

        .notification-icon {
            width: 20px;
            height: 20px;
        }

        .notification-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background: var(--accent);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            border: 2px solid #fff;
        }

        /* ── Alert ────────────────────────────────────── */
        .alert-overdue {
            background: var(--accent-lt);
            border: 1px solid #e8c4b8;
            border-left: 4px solid var(--accent);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.875rem;
            margin-bottom: 2rem;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert-overdue-icon {
            color: var(--accent);
            flex-shrink: 0;
        }

        .alert-overdue p {
            font-size: 0.85rem;
            color: #7a2c12;
        }

        .alert-overdue strong { font-weight: 700; }

        /* ── Stat cards ───────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 14px;
            padding: 1.5rem 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(26,23,20,0.09);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 14px 14px 0 0;
        }

        .stat-card.blue::before  { background: #3b82f6; }
        .stat-card.gold::before  { background: var(--gold); }
        .stat-card.red::before   { background: var(--accent); }

        .stat-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 0.6rem;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .stat-card.blue  .stat-value { color: #2563eb; }
        .stat-card.gold  .stat-value { color: var(--gold); }
        .stat-card.red   .stat-value { color: var(--accent); }

        .stat-icon {
            position: absolute;
            bottom: 1rem; right: 1.25rem;
            opacity: 0.08;
            font-size: 4rem;
            line-height: 1;
        }

        /* ── Two-column layout ────────────────────────── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 1.5rem;
            align-items: start;
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
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--rule);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .card-link {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--accent);
            text-decoration: none;
        }
        .card-link:hover { text-decoration: underline; }

        /* ── Book list ────────────────────────────────── */
        .book-list { list-style: none; }

        .book-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--rule);
            transition: background 0.15s;
        }

        .book-item:last-child { border-bottom: none; }
        .book-item:hover { background: #fdfcfb; }

        .book-cover {
            width: 52px;
            height: 72px;
            border-radius: 5px;
            overflow: hidden;
            flex-shrink: 0;
            background: var(--rule);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 8px rgba(26,23,20,0.12);
        }

        .book-cover img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .book-cover-placeholder {
            font-size: 1.4rem;
            opacity: 0.3;
        }

        .book-meta { flex: 1; min-width: 0; }

        .book-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--ink);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.15rem;
        }

        .book-author {
            font-size: 0.75rem;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        .book-badges {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .badge {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .badge-available { background: var(--teal-lt); color: var(--teal); }
        .badge-borrowed  { background: var(--gold-lt);  color: #8a6115; }

        .book-genre-badge {
            background: #f0eee9;
            color: var(--muted);
        }

        .book-view-btn {
            align-self: center;
            flex-shrink: 0;
            font-size: 0.7rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 4px 10px;
            border: 1px solid #e8c4b8;
            border-radius: 6px;
            transition: background 0.15s, color 0.15s;
        }
        .book-view-btn:hover { background: var(--accent); color: #fff; }

        /* ── Borrowings table ─────────────────────────── */
        .borrow-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
        }

        .borrow-table thead th {
            background: #faf8f5;
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--rule);
        }

        .borrow-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
        }

        .borrow-table tbody tr:last-child { border-bottom: none; }
        .borrow-table tbody tr:hover { background: #fdfcfa; }

        .borrow-table td {
            padding: 0.85rem 1.25rem;
            color: var(--ink);
            vertical-align: middle;
        }

        .borrower-cell {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .borrower-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--rule);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--muted);
            flex-shrink: 0;
        }

        .status-overdue {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--accent-lt);
            color: var(--accent);
        }

        .status-ontime {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--teal-lt);
            color: var(--teal);
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--muted);
            font-size: 0.82rem;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 1100px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 900px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 700px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .main { padding: 1.5rem 1rem 3rem; }
            .stats-grid { grid-template-columns: 1fr; }
        }

        /* ── Modal ────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(26,23,20,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.2s ease;
        }

        .modal-content {
            background: #fff;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(26,23,20,0.3);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            border-bottom: 1px solid var(--rule);
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 6px;
            transition: background 0.15s, color 0.15s;
        }

        .modal-close:hover {
            background: var(--rule);
            color: var(--ink);
        }

        .modal-body {
            padding: 0;
            max-height: 400px;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--rule);
            background: #faf8f5;
            text-align: right;
        }

        .btn-secondary {
            padding: 0.5rem 1rem;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-secondary:hover { background: #2e2a27; }

        /* ── Notifications List ───────────────────────── */
        .notifications-list {
            padding: 0;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--rule);
            transition: background 0.15s;
            cursor: pointer;
        }

        .notification-item:hover {
            background: #faf8f5;
        }

        .notification-item.unread {
            background: var(--teal-lt);
            border-left: 4px solid var(--teal);
        }

        .notification-icon-wrapper {
            flex-shrink: 0;
            width: 40px; height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .notification-book-added .notification-icon-wrapper { background: var(--teal-lt); color: var(--teal); }
        .notification-book-borrowed .notification-icon-wrapper { background: var(--gold-lt); color: #8a6115; }
        .notification-book-returned .notification-icon-wrapper { background: var(--accent-lt); color: var(--accent); }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .notification-message {
            font-size: 0.8rem;
            color: var(--muted);
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .notification-time {
            font-size: 0.7rem;
            color: var(--muted);
            opacity: 0.7;
        }

        .notification-empty {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }

        .notification-empty-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            opacity: 0.3;
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
        <li class="active">
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

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Sign Out
            </button>
        </form>
    </div>

</aside>


{{-- ═══════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════ --}}
<main class="main">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard <span>Overview</span></h1>
            <p class="page-subtitle">A quick glance at your library's current state.</p>
        </div>
        <div class="header-right">
            <div class="header-date">
                <div style="font-size:0.85rem; font-weight:600; color:var(--ink);">{{ now()->format('l') }}</div>
                <div>{{ now()->format('F j, Y') }}</div>
            </div>
            <button id="notification-btn" class="notification-btn">
                <svg class="notification-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span id="notification-count" class="notification-count" style="display: none;">0</span>
            </button>
        </div>
    </div>

    {{-- Overdue Alert --}}
    @if($overdueBooks > 0)
        <div class="alert-overdue">
            <div class="alert-overdue-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
            </div>
            <p><strong>{{ $overdueBooks }} overdue book{{ $overdueBooks > 1 ? 's' : '' }}</strong> — please follow up with borrowers or mark them as returned.</p>
        </div>
    @endif

    {{-- Stat Cards --}}
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-label">Total Books</div>
            <div class="stat-value">{{ $totalBooks }}</div>
            <div class="stat-icon">📚</div>
        </div>
        <div class="stat-card gold">
            <div class="stat-label">Currently Borrowed</div>
            <div class="stat-value">{{ $borrowedBooks }}</div>
            <div class="stat-icon">📖</div>
        </div>
        <div class="stat-card red">
            <div class="stat-label">Overdue Books</div>
            <div class="stat-value">{{ $overdueBooks }}</div>
            <div class="stat-icon">⏰</div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">

        {{-- Recent Borrowings (left / wide) --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Recent Borrowings</span>
                <a href="{{ route('loans.index') }}" class="card-link">View all →</a>
            </div>
            <div style="overflow-x: auto;">
                <table class="borrow-table">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th>Book</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLoans as $loan)
                            <tr>
                                <td>
                                    <div class="borrower-cell">
                                        <div class="borrower-avatar">{{ strtoupper(substr($loan->borrower_name, 0, 1)) }}</div>
                                        {{ $loan->borrower_name }}
                                    </div>
                                </td>
                                <td style="font-weight: 600;">{{ $loan->book->title }}</td>
                                <td style="color: var(--muted); font-size: 0.8rem;">{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>
                                    @if($loan->isOverdue())
                                        <span class="status-overdue">
                                            <svg width="8" height="8" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                            Overdue
                                        </span>
                                    @else
                                        <span class="status-ontime">
                                            <svg width="8" height="8" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                                            On time
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">No borrowing records yet.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Latest Books (right / narrow) --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Latest Books</span>
                <a href="{{ route('books.index') }}" class="card-link">See all →</a>
            </div>

            @if($latestBooks->isEmpty())
                <div class="empty-state">No books yet. <a href="{{ route('books.create') }}" style="color:var(--accent);text-decoration:none;font-weight:600;">Add one.</a></div>
            @else
                <ul class="book-list">
                    @foreach($latestBooks as $book)
                        <li class="book-item">
                            <div class="book-cover">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" />
                                @else
                                    <div class="book-cover-placeholder">📕</div>
                                @endif
                            </div>

                            <div class="book-meta">
                                <div class="book-title">{{ $book->title }}</div>
                                <div class="book-author">{{ $book->author }}</div>
                                <div class="book-badges">
                                    <span class="badge {{ $book->available ? 'badge-available' : 'badge-borrowed' }}">
                                        {{ $book->available ? 'Available' : 'Borrowed' }}
                                    </span>
                                    @if(isset($book->genre) && $book->genre)
                                        <span class="badge book-genre-badge">{{ $book->genre }}</span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('books.show', $book) }}" class="book-view-btn">View</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</main>

{{-- ═══════════════════════════════════════════
     NOTIFICATION MODAL
═══════════════════════════════════════════ --}}
<div id="notification-modal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Notifications</h3>
            <button id="close-modal" class="modal-close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div id="notifications-list" class="notifications-list">
                <!-- Notifications will be loaded here -->
            </div>
        </div>
        <div class="modal-footer">
            <button id="mark-all-read" class="btn-secondary">Mark All as Read</button>
        </div>
    </div>
</div>

<script>
// Notification System
document.addEventListener('DOMContentLoaded', function() {
    const notificationBtn = document.getElementById('notification-btn');
    const notificationModal = document.getElementById('notification-modal');
    const closeModal = document.getElementById('close-modal');
    const markAllReadBtn = document.getElementById('mark-all-read');
    const notificationsList = document.getElementById('notifications-list');
    const notificationCount = document.getElementById('notification-count');

    let notifications = [];

    // Modal controls
    notificationBtn.addEventListener('click', () => {
        notificationModal.style.display = 'flex';
        loadNotifications();
    });

    closeModal.addEventListener('click', () => {
        notificationModal.style.display = 'none';
    });

    notificationModal.addEventListener('click', (e) => {
        if (e.target === notificationModal) {
            notificationModal.style.display = 'none';
        }
    });

    // Load notifications
    async function loadNotifications() {
        try {
            const response = await fetch('/notifications');
            const data = await response.json();
            notifications = data.data;
            renderNotifications();
        } catch (error) {
            console.error('Error loading notifications:', error);
        }
    }

    // Render notifications
    function renderNotifications() {
        if (notifications.length === 0) {
            notificationsList.innerHTML = `
                <div class="notification-empty">
                    <div class="notification-empty-icon">🔔</div>
                    <div>No notifications yet</div>
                </div>
            `;
            return;
        }

        notificationsList.innerHTML = notifications.map(notification => `
            <div class="notification-item ${!notification.read ? 'unread' : ''} notification-${notification.type}"
                 data-id="${notification.id}">
                <div class="notification-icon-wrapper">
                    ${getNotificationIcon(notification.type)}
                </div>
                <div class="notification-content">
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-time">${formatTime(notification.created_at)}</div>
                </div>
            </div>
        `).join('');

        // Add click handlers
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', () => {
                const id = item.dataset.id;
                markAsRead(id);
            });
        });
    }

    // Get notification icon
    function getNotificationIcon(type) {
        switch (type) {
            case 'book_added': return '📚';
            case 'book_borrowed': return '📖';
            case 'book_returned': return '↩️';
            default: return '🔔';
        }
    }

    // Format time
    function formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = now - date;
        const minutes = Math.floor(diff / 60000);
        const hours = Math.floor(diff / 3600000);
        const days = Math.floor(diff / 86400000);

        if (minutes < 1) return 'Just now';
        if (minutes < 60) return `${minutes}m ago`;
        if (hours < 24) return `${hours}h ago`;
        return `${days}d ago`;
    }

    // Mark notification as read
    async function markAsRead(id) {
        try {
            await fetch(`/notifications/${id}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Content-Type': 'application/json',
                },
            });
            await loadNotifications();
            updateUnreadCount();
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    // Mark all as read
    markAllReadBtn.addEventListener('click', async () => {
        try {
            await fetch('/notifications/mark-all-read', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Content-Type': 'application/json',
                },
            });
            await loadNotifications();
            updateUnreadCount();
        } catch (error) {
            console.error('Error marking all notifications as read:', error);
        }
    });

    // Update unread count
    async function updateUnreadCount() {
        try {
            const response = await fetch('/notifications/unread-count');
            const data = await response.json();
            const count = data.count;

            if (count > 0) {
                notificationCount.textContent = count > 99 ? '99+' : count;
                notificationCount.style.display = 'block';
            } else {
                notificationCount.style.display = 'none';
            }
        } catch (error) {
            console.error('Error updating unread count:', error);
        }
    }

    // Initial load
    updateUnreadCount();

    // Poll for new notifications every 30 seconds
    setInterval(updateUnreadCount, 30000);
});
</script>

</body>
</html>