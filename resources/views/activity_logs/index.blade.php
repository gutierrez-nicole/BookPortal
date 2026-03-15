<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Activity Log</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=DM+Sans:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

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
            transition: border-color 0.15s, box-shadow 0.15s;
        }

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

        .chip-total   { }
        .chip-total   .chip-dot { background: var(--ink); }
        .chip-total   .chip-count { color: var(--ink); }

        .chip-creates .chip-dot { background: var(--teal); }
        .chip-creates .chip-count { color: var(--teal); }

        .chip-updates .chip-dot { background: var(--indigo); }
        .chip-updates .chip-count { color: var(--indigo); }

        .chip-deletes .chip-dot { background: var(--accent); }
        .chip-deletes .chip-count { color: var(--accent); }

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

        /* ── Activity table ───────────────────────────── */
        .activity-table { width: 100%; border-collapse: collapse; }

        .activity-table thead th {
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

        .activity-table tbody tr {
            border-bottom: 1px solid var(--rule);
            transition: background 0.12s;
            animation: rowIn 0.22s ease both;
        }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-4px); }
            to   { opacity: 1; transform: none; }
        }

        .activity-table tbody tr:nth-child(1)  { animation-delay: 0.03s; }
        .activity-table tbody tr:nth-child(2)  { animation-delay: 0.06s; }
        .activity-table tbody tr:nth-child(3)  { animation-delay: 0.09s; }
        .activity-table tbody tr:nth-child(4)  { animation-delay: 0.12s; }
        .activity-table tbody tr:nth-child(5)  { animation-delay: 0.15s; }
        .activity-table tbody tr:nth-child(6)  { animation-delay: 0.18s; }
        .activity-table tbody tr:nth-child(7)  { animation-delay: 0.21s; }
        .activity-table tbody tr:nth-child(8)  { animation-delay: 0.24s; }
        .activity-table tbody tr:nth-child(9)  { animation-delay: 0.27s; }
        .activity-table tbody tr:nth-child(10) { animation-delay: 0.30s; }

        .activity-table tbody tr:last-child { border-bottom: none; }
        .activity-table tbody tr:hover { background: #fdfcfa; }

        .activity-table td {
            padding: 0.85rem 1.25rem;
            font-size: 0.83rem;
            vertical-align: middle;
        }

        /* Time cell */
        .time-cell {
            white-space: nowrap;
        }

        .time-main {
            font-size: 0.8rem;
            color: var(--ink);
            font-weight: 500;
        }

        .time-rel {
            font-size: 0.68rem;
            color: var(--muted);
            margin-top: 1px;
        }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 0.6rem; }

        .user-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.68rem; font-weight: 700;
            flex-shrink: 0;
        }

        .user-avatar.human { background: var(--indigo-lt); color: var(--indigo); }
        .user-avatar.system { background: var(--rule); color: var(--muted); }

        .user-name { font-weight: 600; font-size: 0.83rem; }

        /* Action badge */
        .action-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .action-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }

        /* Action colour mapping */
        .action-create   { background: var(--teal-lt);   color: var(--teal); }
        .action-create   .action-dot { background: var(--teal); }

        .action-update   { background: var(--indigo-lt); color: var(--indigo); }
        .action-update   .action-dot { background: var(--indigo); }

        .action-delete   { background: var(--accent-lt); color: var(--accent); }
        .action-delete   .action-dot { background: var(--accent); }

        .action-borrow   { background: var(--gold-lt);   color: #8a6115; }
        .action-borrow   .action-dot { background: var(--gold); }

        .action-return   { background: var(--teal-lt);   color: var(--teal); }
        .action-return   .action-dot { background: var(--teal); }

        .action-reserve  { background: var(--indigo-lt); color: var(--indigo); }
        .action-reserve  .action-dot { background: var(--indigo); }

        .action-cancel   { background: var(--accent-lt); color: var(--accent); }
        .action-cancel   .action-dot { background: var(--accent); }

        .action-login    { background: #f0eee9; color: var(--muted); }
        .action-login    .action-dot { background: var(--muted); }

        .action-default  { background: #f0eee9; color: var(--muted); }
        .action-default  .action-dot { background: var(--muted); }

        /* Subject pill */
        .subject-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 9px;
            border-radius: 20px;
            background: #f0eee9;
            color: var(--muted);
            white-space: nowrap;
        }

        /* Metadata cell */
        .meta-cell {
            max-width: 280px;
        }

        .meta-raw {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            color: var(--muted);
            background: #faf8f5;
            border: 1px solid var(--rule);
            border-radius: 6px;
            padding: 4px 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 240px;
            display: inline-block;
            cursor: pointer;
            transition: background 0.13s;
        }

        .meta-raw:hover { background: var(--rule); }
        .meta-empty { color: var(--rule); font-size: 0.75rem; }

        /* Expand / collapse metadata */
        .meta-expanded {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68rem;
            color: var(--ink);
            background: #faf8f5;
            border: 1px solid var(--rule);
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
            margin-top: 4px;
            white-space: pre-wrap;
            word-break: break-all;
            display: none;
            max-width: 320px;
        }

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
        <li class="active">
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
            <h1 class="page-title">Activity <span>Log</span></h1>
            <p class="page-subtitle">A full audit trail of every action taken in BookPortal.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-outline">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Dashboard
        </a>
    </div>

    {{-- Summary chips --}}
    @php
        $totalLogs    = $logs->total();
        $createCount  = $logs->getCollection()->filter(fn($l) => str_contains(strtolower($l->action), 'creat'))->count();
        $updateCount  = $logs->getCollection()->filter(fn($l) => str_contains(strtolower($l->action), 'updat') || str_contains(strtolower($l->action), 'edit'))->count();
        $deleteCount  = $logs->getCollection()->filter(fn($l) => str_contains(strtolower($l->action), 'delet') || str_contains(strtolower($l->action), 'cancel'))->count();
    @endphp

    <div class="summary-row">
        <div class="summary-chip chip-total">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $totalLogs }}</span>
            <span class="chip-label">Total Events</span>
        </div>
        <div class="summary-chip chip-creates">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $createCount }}</span>
            <span class="chip-label">Creates</span>
        </div>
        <div class="summary-chip chip-updates">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $updateCount }}</span>
            <span class="chip-label">Updates</span>
        </div>
        <div class="summary-chip chip-deletes">
            <span class="chip-dot"></span>
            <span class="chip-count">{{ $deleteCount }}</span>
            <span class="chip-label">Deletes / Cancels</span>
        </div>
    </div>

    {{-- Table card --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-count">
                Showing <strong>{{ $logs->count() }}</strong> of <strong>{{ $logs->total() }}</strong> events
            </span>
            <span style="font-size:0.72rem; color:var(--muted);">Most recent first</span>
        </div>

        <div style="overflow-x: auto;">
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Subject</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $action     = strtolower($log->action ?? '');
                            $actionClass = match(true) {
                                str_contains($action, 'creat')   => 'action-create',
                                str_contains($action, 'updat') || str_contains($action, 'edit') => 'action-update',
                                str_contains($action, 'delet')   => 'action-delete',
                                str_contains($action, 'borrow')  => 'action-borrow',
                                str_contains($action, 'return')  => 'action-return',
                                str_contains($action, 'reserv')  => 'action-reserve',
                                str_contains($action, 'cancel')  => 'action-cancel',
                                str_contains($action, 'login') || str_contains($action, 'logout') => 'action-login',
                                default                           => 'action-default',
                            };
                            $actionLabel = str_replace('_', ' ', ucfirst($log->action));
                            $subject     = class_basename($log->subject_type ?? '');
                            $meta        = $log->metadata ?? [];
                            $metaJson    = json_encode($meta, JSON_PRETTY_PRINT);
                            $metaShort   = is_array($meta) && count($meta) > 0
                                ? collect($meta)->map(fn($v, $k) => "$k: $v")->take(2)->implode(', ')
                                : null;
                            $isSystem    = empty($log->user);
                        @endphp
                        <tr>

                            {{-- Time --}}
                            <td class="time-cell">
                                <div class="time-main">{{ $log->created_at->format('M d, Y') }}</div>
                                <div class="time-rel">{{ $log->created_at->format('H:i') }} · {{ $log->created_at->diffForHumans() }}</div>
                            </td>

                            {{-- User --}}
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar {{ $isSystem ? 'system' : 'human' }}">
                                        {{ $isSystem ? '⚙' : strtoupper(substr($log->user?->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <span class="user-name">{{ $log->user?->name ?? 'System' }}</span>
                                </div>
                            </td>

                            {{-- Action --}}
                            <td>
                                <span class="action-badge {{ $actionClass }}">
                                    <span class="action-dot"></span>
                                    {{ $actionLabel }}
                                </span>
                            </td>

                            {{-- Subject --}}
                            <td>
                                @if($subject)
                                    <span class="subject-pill">
                                        {{ $subject }}
                                        @if(isset($log->subject_id))
                                            #{{ $log->subject_id }}
                                        @endif
                                    </span>
                                @else
                                    <span class="meta-empty">—</span>
                                @endif
                            </td>

                            {{-- Details / Metadata --}}
                            <td class="meta-cell">
                                @if($metaShort)
                                    <span
                                        class="meta-raw"
                                        onclick="toggleMeta(this)"
                                        title="Click to expand"
                                    >{{ $metaShort }}</span>
                                    <div class="meta-expanded">{{ $metaJson }}</div>
                                @else
                                    <span class="meta-empty">—</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">📋</div>
                                    <div class="empty-title">No activity logged yet</div>
                                    <div class="empty-sub">Events will appear here as the system is used.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="pagination-wrap">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</main>

<script>
    function toggleMeta(el) {
        const expanded = el.nextElementSibling;
        const open = expanded.style.display === 'block';
        expanded.style.display = open ? 'none' : 'block';
        el.style.opacity = open ? '1' : '0.5';
    }
</script>

</body>
</html>