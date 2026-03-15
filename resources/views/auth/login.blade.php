<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookPortal — Sign In</title>

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

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
        }

        /* ── Two-panel layout ─────────────────────────── */
        .login-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── Left decorative panel ────────────────────── */
        .panel-left {
            background: var(--ink);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
            overflow: hidden;
        }

        /* Grain overlay */
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: 0.4;
        }

        /* Decorative circles */
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -120px;
            right: -80px;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .deco-circle-1 { width: 300px; height: 300px; top: -80px; left: -60px; }
        .deco-circle-2 { width: 200px; height: 200px; bottom: 80px; right: -40px; }
        .deco-circle-3 { width: 120px; height: 120px; top: 40%; left: 60%; }

        .deco-line {
            position: absolute;
            background: rgba(255,255,255,0.04);
            pointer-events: none;
        }

        .deco-line-h { height: 1px; left: 0; right: 0; }
        .deco-line-h-1 { top: 33%; }
        .deco-line-h-2 { top: 66%; }

        /* Left panel content */
        .panel-brand {
            position: relative;
            z-index: 1;
        }

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

        /* Book stack illustration */
        .book-stack {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .book-spines {
            display: flex;
            align-items: flex-end;
            gap: 6px;
        }

        .spine {
            border-radius: 4px 4px 2px 2px;
            position: relative;
            transition: transform 0.3s ease;
        }

        .spine:hover { transform: translateY(-8px); }

        .spine-1 { width: 34px; height: 180px; background: linear-gradient(180deg, #4a6fa5, #2d4a73); }
        .spine-2 { width: 28px; height: 210px; background: linear-gradient(180deg, var(--gold), #9e7528); }
        .spine-3 { width: 32px; height: 155px; background: linear-gradient(180deg, #6b4c3b, #3d2a1e); }
        .spine-4 { width: 26px; height: 230px; background: linear-gradient(180deg, #2d8a6e, #1a5442); }
        .spine-5 { width: 36px; height: 175px; background: linear-gradient(180deg, #8a4a6e, #5a2a48); }
        .spine-6 { width: 30px; height: 200px; background: linear-gradient(180deg, #c0622a, #8a3a14); }
        .spine-7 { width: 24px; height: 145px; background: linear-gradient(180deg, #5a7a5a, #3a5a3a); }

        .spine::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            border-radius: 4px 0 0 2px;
            background: rgba(255,255,255,0.12);
        }

        /* Quote */
        .panel-quote {
            position: relative;
            z-index: 1;
        }

        .quote-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-style: italic;
            color: rgba(255,255,255,0.7);
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        .quote-attr {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.3);
        }

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
            max-width: 380px;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }

        /* Form header */
        .form-heading {
            margin-bottom: 2rem;
        }

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

        /* Flash messages */
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
        .flash-info    { background: var(--gold-lt); color: #7a5c10; border: 1px solid #e8d5a0; }

        /* Fields */
        .field { margin-bottom: 1.1rem; }

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

        /* Password toggle */
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

        /* Divider row */
        .form-row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        /* Remember me */
        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            color: var(--muted);
            cursor: pointer;
            user-select: none;
        }

        .remember-check {
            width: 16px; height: 16px;
            border: 1.5px solid var(--rule);
            border-radius: 4px;
            background: #fff;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: background 0.13s, border-color 0.13s;
            flex-shrink: 0;
            position: relative;
        }

        .remember-check:checked {
            background: var(--ink);
            border-color: var(--ink);
        }

        .remember-check:checked::after {
            content: '';
            position: absolute;
            top: 2px; left: 5px;
            width: 4px; height: 8px;
            border-right: 2px solid #fff;
            border-bottom: 2px solid #fff;
            transform: rotate(45deg);
        }

        /* Forgot */
        .forgot-link {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.13s;
        }

        .forgot-link:hover { color: var(--ink); }

        /* Submit button */
        .btn-login {
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
            margin-bottom: 1.25rem;
        }

        .btn-login:hover { background: #2e2a27; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        /* Divider */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .form-divider-line { flex: 1; height: 1px; background: var(--rule); }
        .form-divider-text { font-size: 0.7rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }

        /* Register link */
        .register-row {
            text-align: center;
            font-size: 0.78rem;
            color: var(--muted);
        }

        .register-row a {
            color: var(--accent);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.13s;
        }

        .register-row a:hover { color: #9b3a15; }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 768px) {
            .login-shell { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 2.5rem 1.5rem; min-height: 100vh; }
        }
    </style>
</head>
<body>

<div class="login-shell">

    {{-- ── Left decorative panel ── --}}
    <div class="panel-left">
        <div class="deco-circle deco-circle-1"></div>
        <div class="deco-circle deco-circle-2"></div>
        <div class="deco-circle deco-circle-3"></div>
        <div class="deco-line deco-line-h deco-line-h-1"></div>
        <div class="deco-line deco-line-h deco-line-h-2"></div>

        <div class="panel-brand">
            <div class="brand-name">Book<em>Portal</em></div>
            <div class="brand-tagline">Library Management System</div>
        </div>

        <div class="book-stack">
            <div class="book-spines">
                <div class="spine spine-1"></div>
                <div class="spine spine-2"></div>
                <div class="spine spine-3"></div>
                <div class="spine spine-4"></div>
                <div class="spine spine-5"></div>
                <div class="spine spine-6"></div>
                <div class="spine spine-7"></div>
            </div>
        </div>

        <div class="panel-quote">
            <p class="quote-text">"A room without books is like a body without a soul."</p>
            <p class="quote-attr">— Marcus Tullius Cicero</p>
        </div>
    </div>

    {{-- ── Right form panel ── --}}
    <div class="panel-right">
        <div class="form-wrap">

            <div class="form-heading">
                <div class="form-heading-label">Welcome back</div>
                <h1 class="form-heading-title">Sign in to<br>your library</h1>
                <p class="form-heading-sub">Enter your credentials to access BookPortal.</p>
            </div>

            {{-- Flash messages --}}
            @if(session('status'))
                <div class="flash flash-info">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ session('status') }}
                </div>
            @endif

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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="field-input {{ $errors->has('email') ? 'has-error' : '' }}"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
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

                {{-- Password --}}
                <div class="field">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="field-input {{ $errors->has('password') ? 'has-error' : '' }}"
                            placeholder="Your password"
                            required
                            autocomplete="current-password"
                            style="padding-right: 2.75rem;"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePassword()" id="pwToggleBtn" aria-label="Show/hide password">
                            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="form-row-between">
                    <label class="remember-label" for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember" class="remember-check" />
                        Remember me
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Sign In
                </button>

                {{-- Register link --}}
                @if(Route::has('register'))
                    <div class="form-divider">
                        <div class="form-divider-line"></div>
                        <span class="form-divider-text">or</span>
                        <div class="form-divider-line"></div>
                    </div>

                    <div class="register-row">
                        Don't have an account?
                        <a href="{{ route('register') }}">Create one</a>
                    </div>
                @endif

            </form>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        const show  = input.type === 'password';

        input.type = show ? 'text' : 'password';

        icon.innerHTML = show
            ? `<line x1="1" y1="1" x2="23" y2="23"/>
               <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
               <path d="M1 12s4-8 11-8"/><path d="M1 12s4 8 11 8a9.14 9.14 0 006.72-3.07"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }
</script>

</body>
</html>