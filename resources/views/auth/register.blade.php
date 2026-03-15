<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Create Account</title>

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
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--ink); }

        /* ── Two-panel layout ─────────────────────────── */
        .login-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── Left panel ───────────────────────────────── */
        .panel-left {
            background: var(--ink);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: 0.4;
        }

        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .deco-circle-1 { width: 320px; height: 320px; bottom: -100px; right: -80px; }
        .deco-circle-2 { width: 180px; height: 180px; top: 60px; right: 40px; }
        .deco-circle-3 { width: 90px; height: 90px; top: 45%; left: 55%; }

        .deco-line { position: absolute; background: rgba(255,255,255,0.04); pointer-events: none; }
        .deco-line-v { width: 1px; top: 0; bottom: 0; }
        .deco-line-v-1 { left: 33%; }
        .deco-line-v-2 { left: 66%; }

        .panel-brand { position: relative; z-index: 1; }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            color: #fff;
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .brand-name em { font-style: italic; color: var(--gold); }

        .brand-tagline {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255,255,255,0.3);
            margin-top: 0.5rem;
        }

        /* Feature list in left panel */
        .feature-list {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
            padding: 2rem 0;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .feature-text { }

        .feature-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
            margin-bottom: 0.15rem;
        }

        .feature-desc {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.35);
            line-height: 1.45;
        }

        /* Bottom note */
        .panel-note {
            position: relative;
            z-index: 1;
            font-size: 0.7rem;
            color: rgba(255,255,255,0.2);
            line-height: 1.5;
        }

        .panel-note a { color: rgba(255,255,255,0.35); text-decoration: none; }
        .panel-note a:hover { color: rgba(255,255,255,0.6); }

        /* ── Right form panel ─────────────────────────── */
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            background: var(--cream);
        }

        .form-wrap {
            width: 100%;
            max-width: 400px;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        /* Form header */
        .form-heading { margin-bottom: 1.75rem; }

        .form-heading-label {
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--gold);
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .form-heading-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--ink);
        }

        .form-heading-sub {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 0.3rem;
        }

        /* Flash */
        .flash {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 1rem;
            border-radius: 9px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: none; } }

        .flash-success { background: var(--teal-lt); color: var(--teal); border: 1px solid #b0d8d2; }
        .flash-error   { background: var(--accent-lt); color: var(--accent); border: 1px solid #e8c4b8; }

        /* Two-column row */
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.875rem;
            margin-bottom: 1rem;
        }

        /* Fields */
        .field { margin-bottom: 1rem; }
        .field:last-of-type { margin-bottom: 0; }

        .field-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .field-input-wrap { position: relative; }

        .field-input {
            width: 100%;
            height: 42px;
            padding: 0 0.9rem 0 2.5rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--ink);
            background: #fff;
            border: 1px solid var(--rule);
            border-radius: 10px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .field-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,151,58,0.13);
        }

        .field-input.has-error { border-color: var(--accent); }
        .field-input.has-error:focus { box-shadow: 0 0 0 3px rgba(181,69,27,0.12); }

        .field-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .pw-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 2px;
            display: flex;
            align-items: center;
            transition: color 0.13s;
        }

        .pw-toggle:hover { color: var(--ink); }

        .field-error {
            font-size: 0.71rem;
            color: var(--accent);
            font-weight: 500;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Password strength meter */
        .strength-wrap { margin-top: 0.5rem; }

        .strength-bars {
            display: flex;
            gap: 4px;
            margin-bottom: 0.3rem;
        }

        .strength-bar {
            flex: 1;
            height: 4px;
            border-radius: 2px;
            background: var(--rule);
            transition: background 0.25s ease;
        }

        .strength-bar.active-weak   { background: var(--accent); }
        .strength-bar.active-fair   { background: var(--gold); }
        .strength-bar.active-good   { background: #5b8dd9; }
        .strength-bar.active-strong { background: var(--teal); }

        .strength-label {
            font-size: 0.67rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
            transition: color 0.25s;
        }

        /* Password match indicator */
        .match-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 0.4rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .match-indicator.visible { opacity: 1; }
        .match-ok   { color: var(--teal); }
        .match-fail { color: var(--accent); }

        /* Submit */
        .btn-register {
            width: 100%;
            height: 44px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #fff;
            background: var(--ink);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .btn-register:hover { background: #2e2a27; transform: translateY(-1px); }
        .btn-register:active { transform: translateY(0); }

        /* Divider + login link */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .form-divider-line { flex: 1; height: 1px; background: var(--rule); }
        .form-divider-text { font-size: 0.7rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }

        .login-row {
            text-align: center;
            font-size: 0.78rem;
            color: var(--muted);
        }

        .login-row a {
            color: var(--accent);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.13s;
        }

        .login-row a:hover { color: #9b3a15; }

        /* Terms note */
        .terms-note {
            font-size: 0.68rem;
            color: var(--muted);
            text-align: center;
            margin-top: 1rem;
            line-height: 1.5;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 768px) {
            .login-shell { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 2.5rem 1.5rem; min-height: 100vh; }
            .field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="login-shell">

    {{-- ── Left panel ── --}}
    <div class="panel-left">
        <div class="deco-circle deco-circle-1"></div>
        <div class="deco-circle deco-circle-2"></div>
        <div class="deco-circle deco-circle-3"></div>
        <div class="deco-line deco-line-v deco-line-v-1"></div>
        <div class="deco-line deco-line-v deco-line-v-2"></div>

        <div class="panel-brand">
            <div class="brand-name">Book<em>Portal</em></div>
            <div class="brand-tagline">Library Management System</div>
        </div>

        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-icon">📚</div>
                <div class="feature-text">
                    <div class="feature-title">Full Catalogue Management</div>
                    <div class="feature-desc">Add, edit, and browse every book in your library collection from one place.</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📖</div>
                <div class="feature-text">
                    <div class="feature-title">Borrowing & Returns</div>
                    <div class="feature-desc">Track active loans, overdue items, and mark returns in seconds.</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📅</div>
                <div class="feature-text">
                    <div class="feature-title">Reservation System</div>
                    <div class="feature-desc">Let borrowers reserve books in advance, even if currently on loan.</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📊</div>
                <div class="feature-text">
                    <div class="feature-title">Reports & Analytics</div>
                    <div class="feature-desc">Discover your most borrowed titles and keep overdue accounts in check.</div>
                </div>
            </div>
        </div>

        <div class="panel-note">
            Already have an account? <a href="{{ route('login') }}">Sign in instead →</a>
        </div>
    </div>

    {{-- ── Right form panel ── --}}
    <div class="panel-right">
        <div class="form-wrap">

            <div class="form-heading">
                <div class="form-heading-label">Get started</div>
                <h1 class="form-heading-title">Create your<br>librarian account</h1>
                <p class="form-heading-sub">Set up your BookPortal account in seconds.</p>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div class="flash flash-success">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="flash flash-error">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name + Email row --}}
                <div class="field-row">
                    <div class="field">
                        <label class="field-label" for="name">Full Name</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <input
                                id="name" name="name" type="text"
                                class="field-input {{ $errors->has('name') ? 'has-error' : '' }}"
                                value="{{ old('name') }}"
                                placeholder="Your name"
                                required autofocus
                                autocomplete="name"
                            />
                        </div>
                        @error('name')
                            <div class="field-error">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label" for="email">Email</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <input
                                id="email" name="email" type="email"
                                class="field-input {{ $errors->has('email') ? 'has-error' : '' }}"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                                autocomplete="username"
                            />
                        </div>
                        @error('email')
                            <div class="field-error">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="field">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input
                            id="password" name="password" type="password"
                            class="field-input {{ $errors->has('password') ? 'has-error' : '' }}"
                            placeholder="Create a strong password"
                            required
                            autocomplete="new-password"
                            oninput="checkStrength(this.value); checkMatch()"
                            style="padding-right: 2.75rem;"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePw('password','eyePw')" aria-label="Toggle password">
                            <svg id="eyePw" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    {{-- Strength meter --}}
                    <div class="strength-wrap">
                        <div class="strength-bars">
                            <div class="strength-bar" id="sb1"></div>
                            <div class="strength-bar" id="sb2"></div>
                            <div class="strength-bar" id="sb3"></div>
                            <div class="strength-bar" id="sb4"></div>
                        </div>
                        <span class="strength-label" id="strengthLabel">Enter a password</span>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Confirm password --}}
                <div class="field">
                    <label class="field-label" for="password_confirmation">Confirm Password</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="field-input {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
                            placeholder="Repeat your password"
                            required
                            autocomplete="new-password"
                            oninput="checkMatch()"
                            style="padding-right: 2.75rem;"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation','eyeConfirm')" aria-label="Toggle confirm password">
                            <svg id="eyeConfirm" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="match-indicator" id="matchIndicator"></div>
                    @error('password_confirmation')
                        <div class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-register">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Create Account
                </button>

                <div class="form-divider">
                    <div class="form-divider-line"></div>
                    <span class="form-divider-text">or</span>
                    <div class="form-divider-line"></div>
                </div>

                <div class="login-row">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>

                <p class="terms-note">
                    By creating an account you agree to BookPortal's terms of use and privacy policy.
                </p>

            </form>
        </div>
    </div>

</div>

<script>
    /* ── Password visibility toggle ── */
    function togglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        const show  = input.type === 'password';
        input.type  = show ? 'text' : 'password';
        icon.innerHTML = show
            ? `<line x1="1" y1="1" x2="23" y2="23"/>
               <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
               <path d="M1 12s4-8 11-8"/><path d="M1 12s4 8 11 8a9.14 9.14 0 006.72-3.07"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }

    /* ── Password strength ── */
    function checkStrength(val) {
        const bars   = [document.getElementById('sb1'), document.getElementById('sb2'), document.getElementById('sb3'), document.getElementById('sb4')];
        const label  = document.getElementById('strengthLabel');

        let score = 0;
        if (val.length >= 8)                       score++;
        if (/[A-Z]/.test(val))                     score++;
        if (/[0-9]/.test(val))                     score++;
        if (/[^A-Za-z0-9]/.test(val))              score++;

        const levels = [
            { cls: '',              text: 'Enter a password',  color: 'var(--muted)' },
            { cls: 'active-weak',   text: 'Weak',              color: 'var(--accent)' },
            { cls: 'active-fair',   text: 'Fair',              color: 'var(--gold)' },
            { cls: 'active-good',   text: 'Good',              color: '#5b8dd9' },
            { cls: 'active-strong', text: 'Strong',            color: 'var(--teal)' },
        ];

        const level = val.length === 0 ? 0 : Math.max(1, score);

        bars.forEach((bar, i) => {
            bar.className = 'strength-bar';
            if (i < level && levels[level].cls) bar.classList.add(levels[level].cls);
        });

        label.textContent   = levels[level].text;
        label.style.color   = levels[level].color;
    }

    /* ── Password match check ── */
    function checkMatch() {
        const pw      = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const el      = document.getElementById('matchIndicator');

        if (!confirm) { el.classList.remove('visible'); return; }

        el.classList.add('visible');

        if (pw === confirm) {
            el.className = 'match-indicator visible match-ok';
            el.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Passwords match`;
        } else {
            el.className = 'match-indicator visible match-fail';
            el.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Passwords don't match`;
        }
    }
</script>

</body>
</html>