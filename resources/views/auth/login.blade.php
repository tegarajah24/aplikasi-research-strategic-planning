<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — RSP-UHB</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        /* ── Page background ── */
        html, body {
            height: 100%;
            margin: 0;
        }

        .page-bg {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background-color: #f0ecff;
            background-image:
                radial-gradient(ellipse at 20% 30%, rgba(109,63,196,0.18) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 70%, rgba(249,115,22,0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 55% 10%, rgba(155,89,214,0.10) 0%, transparent 45%);
        }

        /* ── Login Box (card) ── */
        .login-box {
            display: flex;
            width: 100%;
            max-width: 860px;
            min-height: 520px;
            border-radius: 22px;
            overflow: hidden;
            box-shadow:
                0 32px 80px -12px rgba(109,63,196,0.25),
                0 8px 24px -4px rgba(0,0,0,0.10);
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            flex: 0 0 48%;
            position: relative;
            overflow: hidden;
            background: linear-gradient(140deg, #3b2f8f 0%, #6d3fc4 38%, #9b59d6 65%, #e06a4e 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2.75rem 2.5rem;
        }

        /* animated blob shapes */
        .blob {
            position: absolute;
            border-radius: 50%;
            opacity: 0.20;
            animation: blobFloat 8s ease-in-out infinite;
        }
        .blob-1 {
            width: 260px; height: 260px;
            background: #f97316;
            bottom: -70px; left: -60px;
            animation-delay: 0s;
        }
        .blob-2 {
            width: 180px; height: 180px;
            background: #fb923c;
            bottom: 60px; left: 120px;
            animation-delay: 1.5s;
        }
        .blob-3 {
            width: 130px; height: 130px;
            background: #fdba74;
            bottom: 170px; left: 30px;
            opacity: 0.12;
            animation-delay: 3s;
        }

        @keyframes blobFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-16px) scale(1.04); }
        }

        /* diagonal pill decorations */
        .pill {
            position: absolute;
            border-radius: 50px;
            animation: pillDrift 10s ease-in-out infinite;
        }
        .pill-1 {
            width: 75px; height: 23px;
            background: rgba(249,115,22,0.55);
            bottom: 220px; right: 28px;
            transform: rotate(-38deg);
            animation-delay: 0s;
        }
        .pill-2 {
            width: 100px; height: 23px;
            background: rgba(251,146,60,0.50);
            bottom: 170px; right: 58px;
            transform: rotate(-38deg);
            animation-delay: 1s;
        }
        .pill-3 {
            width: 60px; height: 18px;
            background: rgba(253,186,116,0.55);
            bottom: 265px; right: 95px;
            transform: rotate(-38deg);
            animation-delay: 2s;
        }
        .pill-4 {
            width: 85px; height: 21px;
            background: rgba(249,115,22,0.35);
            bottom: 115px; right: 22px;
            transform: rotate(-38deg);
            animation-delay: 0.5s;
        }
        .pill-5 {
            width: 48px; height: 16px;
            background: rgba(253,186,116,0.45);
            bottom: 305px; right: 45px;
            transform: rotate(-38deg);
            animation-delay: 3s;
        }

        @keyframes pillDrift {
            0%, 100% { transform: rotate(-38deg) translateY(0); }
            50%       { transform: rotate(-38deg) translateY(-10px); }
        }

        .left-content { position: relative; z-index: 10; }

        .left-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
        }
        .left-logo-icon {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.18);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(255,255,255,0.28);
        }
        .left-logo-text .brand {
            font-size: 0.95rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
            line-height: 1;
        }
        .left-logo-text .tagline {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.65);
            margin-top: 2px;
            line-height: 1;
        }

        .left-headline {
            color: #fff;
            font-size: clamp(1.4rem, 2.2vw, 1.85rem);
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.03em;
            margin: 0 0 0.85rem;
        }
        .left-sub {
            color: rgba(255,255,255,0.72);
            font-size: 0.82rem;
            line-height: 1.65;
            margin: 0 0 2rem;
        }

        /* feature pills */
        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }
        .feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.22);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }
        .feature-pill-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: rgba(255,255,255,0.85);
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            flex: 1;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2.75rem 2.5rem;
        }

        .form-header { margin-bottom: 1.75rem; }
        .form-header .welcome-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f0eaff;
            color: #6d3fc4;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 0.75rem;
        }
        .form-header h1 {
            font-size: 1.45rem;
            font-weight: 800;
            color: #1e1b4b;
            letter-spacing: -0.03em;
            margin: 0 0 0.3rem;
        }
        .form-header p {
            font-size: 0.8rem;
            color: #6b7280;
            margin: 0;
        }

        /* input groups */
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.35rem;
        }
        .input-group {
            position: relative;
            margin-bottom: 0.9rem;
        }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: #a78bfa;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 1.5px solid #e9e3ff;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #1f2937;
            background: #faf8ff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: #c4b5fd; }
        .form-input:focus {
            border-color: #7c3aed;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(109,63,196,0.10);
        }

        /* remember + forgot */
        .form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.1rem 0 1.25rem;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            color: #6b7280;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 14px; height: 14px;
            accent-color: #7c3aed;
            cursor: pointer;
        }
        .forgot-link {
            font-size: 0.78rem;
            color: #7c3aed;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #5b21b6; }

        /* submit button */
        .btn-login {
            width: 100%;
            padding: 11px;
            background: linear-gradient(135deg, #6d3fc4 0%, #9b59d6 100%);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 18px -4px rgba(109,63,196,0.45);
            transition: transform 0.18s, box-shadow 0.18s, filter 0.18s;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            filter: brightness(1.07);
            box-shadow: 0 8px 24px -4px rgba(109,63,196,0.55);
        }
        .btn-login:active { transform: translateY(0); }

        /* alerts */
        .validation-errors {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 9px 13px;
            margin-bottom: 1rem;
            font-size: 0.79rem;
            color: #b91c1c;
        }
        .validation-errors ul { margin: 0; padding-left: 1rem; }
        .validation-errors ul li { margin: 2px 0; }

        .status-msg {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 9px 13px;
            margin-bottom: 1rem;
            font-size: 0.79rem;
            color: #15803d;
            font-weight: 600;
        }

        /* back link */
        .back-link {
            text-align: center;
            margin-top: 1.4rem;
            font-size: 0.78rem;
            color: #9ca3af;
        }
        .back-link a {
            color: #7c3aed;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link a:hover { color: #5b21b6; }

        /* Responsive */
        @media (max-width: 640px) {
            .login-box { flex-direction: column; border-radius: 16px; }
            .left-panel {
                flex: 0 0 auto;
                padding: 2rem 1.75rem 1.75rem;
            }
            .pill, .blob-2, .blob-3 { display: none; }
            .right-panel { padding: 2rem 1.75rem; }
        }
    </style>
</head>
<body>

<div class="page-bg">
    <div class="login-box">

        {{-- ══════════ LEFT PANEL ══════════ --}}
        <div class="left-panel">

            {{-- Decorative blobs --}}
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>

            {{-- Decorative pills --}}
            <div class="pill pill-1"></div>
            <div class="pill pill-2"></div>
            <div class="pill pill-3"></div>
            <div class="pill pill-4"></div>
            <div class="pill pill-5"></div>

            <div class="left-content">

                {{-- Logo --}}
                <div class="left-logo">
                    <div class="left-logo-icon">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                    </div>
                    <div class="left-logo-text">
                        <div class="brand">RSP-UHB</div>
                        <div class="tagline">Research &amp; Strategic Planning</div>
                    </div>
                </div>

                {{-- Headline --}}
                <h1 class="left-headline">
                    Selamat Datang<br>di Sistem RSP-UHB
                </h1>
                <p class="left-sub">
                    Platform terintegrasi untuk merencanakan, mengelola, dan memonitor penelitian &amp; rencana strategis Universitas Harapan Bangsa.
                </p>

                {{-- Feature pills --}}
                <div class="feature-pills">
                    <span class="feature-pill"><span class="feature-pill-dot"></span>Penelitian</span>
                    <span class="feature-pill"><span class="feature-pill-dot"></span>Pengabmas</span>
                    <span class="feature-pill"><span class="feature-pill-dot"></span>HKI &amp; Publikasi</span>
                    <span class="feature-pill"><span class="feature-pill-dot"></span>Renop</span>
                    <span class="feature-pill"><span class="feature-pill-dot"></span>Kerja Sama</span>
                </div>

            </div>
        </div>

        {{-- ══════════ RIGHT PANEL ══════════ --}}
        <div class="right-panel">

            {{-- Header --}}
            <div class="form-header">
                <div class="welcome-tag">
                    <svg width="8" height="8" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                    Universitas Harapan Bangsa
                </div>
                <h1>Masuk ke Akun</h1>
                <p>Gunakan username &amp; password yang telah diberikan</p>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="validation-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Session Status --}}
            @session('status')
                <div class="status-msg">{{ $value }}</div>
            @endsession

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Username --}}
                <label class="form-label" for="username">Username</label>
                <div class="input-group">
                    <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                    <input
                        id="username"
                        class="form-input"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                {{-- Password --}}
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                    <input
                        id="password"
                        class="form-input"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                {{-- Remember & Forgot --}}
                <div class="form-meta">
                    <label class="remember-label" for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="btn-login-submit">
                    MASUK
                </button>
            </form>

            {{-- Back to home --}}
            <div class="back-link">
                <a href="{{ url('/') }}">&larr; Kembali ke Beranda</a>
            </div>

        </div>
    </div>
</div>

@livewireScripts
</body>
</html>
