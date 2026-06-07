<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODC · Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: #f5f7fb;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ---- LEFT PANEL ---- */
        .left-panel {
            background: radial-gradient(ellipse at 30% 40%, #1d4b63, #0a2a38);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(249,115,22,0.08);
            top: -80px;
            right: -100px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: 60px;
            left: -80px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 2;
        }
        .brand-logo .logo-box {
            width: 46px;
            height: 46px;
            background: #f97316;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 1rem;
        }
        .brand-logo span {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
        }
        .brand-logo span em {
            color: #f97316;
            font-style: normal;
        }

        .left-hero {
            z-index: 2;
            color: white;
        }
        .left-hero h1 {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .left-hero p {
            font-size: 1.05rem;
            opacity: 0.75;
            margin-top: 1rem;
            max-width: 360px;
        }

        .left-stats {
            z-index: 2;
            display: flex;
            gap: 2rem;
        }
        .stat-item {
            color: white;
        }
        .stat-item .num {
            font-size: 1.7rem;
            font-weight: 800;
            color: #f97316;
        }
        .stat-item .lbl {
            font-size: 0.78rem;
            opacity: 0.6;
            display: block;
            margin-top: 2px;
        }

        .big-icon {
            position: absolute;
            bottom: 100px;
            right: -20px;
            font-size: 14rem;
            color: rgba(255,255,255,0.04);
            z-index: 1;
        }

        /* ---- RIGHT PANEL ---- */
        .right-panel {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            background: #f5f7fb;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
        }

        .login-card .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff4e5;
            color: #f97316;
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid #fde8d0;
        }

        .login-card h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0b2b40;
            letter-spacing: -0.02em;
        }
        .login-card .sub {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 0.4rem;
            margin-bottom: 2rem;
        }

        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
            display: block;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 1.25rem;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #0b2b40;
            background: white;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .input-wrap input:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249,115,22,0.12);
        }
        .input-wrap input::placeholder { color: #b0bec5; }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: #f97316; }

        .forgot-link {
            color: #f97316;
            font-size: 0.83rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .forgot-link:hover { opacity: 0.75; }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.87rem;
            color: #475569;
            cursor: pointer;
        }
        .remember-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #f97316;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: #f97316;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 8px 20px rgba(249,115,22,0.35);
            margin-top: 1.5rem;
        }
        .btn-login:hover {
            background: #e9600c;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(249,115,22,0.45);
        }
        .btn-login:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.5rem 0;
            color: #cbd5e1;
            font-size: 0.82rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .register-options {
            display: flex;
            gap: 12px;
        }
        .register-options a {
            flex: 1;
            text-align: center;
            padding: 0.7rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.83rem;
            font-weight: 600;
            color: #0b2b40;
            text-decoration: none;
            transition: all 0.2s;
            background: white;
        }
        .register-options a:hover {
            border-color: #f97316;
            color: #f97316;
            background: #fff8f3;
        }
        .register-options a i { margin-right: 5px; }

        /* Error state */
        .input-wrap input.is-error { border-color: #ef4444; }
        .error-msg {
            color: #ef4444;
            font-size: 0.78rem;
            margin-top: -0.85rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Session alert */
        .alert-session {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.88rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 767px) {
            .left-panel { min-height: auto; padding: 2rem 1.5rem; border-radius: 0 0 2rem 2rem; }
            .left-stats { gap: 1.2rem; }
            .big-icon { display: none; }
            .right-panel { padding: 2rem 1.2rem; }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- ====== LEFT PANEL ====== -->
        <div class="col-lg-5 d-none d-lg-flex">
            <div class="left-panel w-100">
                <div class="brand-logo">
                    <div class="logo-box">ODC</div>
                    <span>OneDay<em>Contract</em></span>
                </div>

                <div class="left-hero">
                    <h1>Welcome back to ODC management.</h1>
                    <p>One platform for manpower, property, rentals, and services — all in a single day.</p>
                </div>

                <div class="left-stats">
                    <div class="stat-item">
                        <div class="num">700+</div>
                        <span class="lbl">Daily Workers</span>
                    </div>
                    <div class="stat-item">
                        <div class="num">240+</div>
                        <span class="lbl">Companies</span>
                    </div>
                    <div class="stat-item">
                        <div class="num">6</div>
                        <span class="lbl">Managed Services</span>
                    </div>
                </div>

                <i class="fas fa-handshake big-icon"></i>
            </div>
        </div>

        <!-- ====== RIGHT PANEL ====== -->
        <div class="col-lg-7 col-12">
            <div class="right-panel">
                <div class="login-card">

                    <!-- Mobile brand -->
                    <div class="d-flex align-items-center gap-2 mb-4 d-lg-none">
                        <div style="width:36px;height:36px;background:#f97316;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:800;color:white;font-size:0.8rem;">ODC</div>
                        <span style="font-weight:700;color:#0b2b40;font-size:1.1rem;">OneDay<span style="color:#f97316;">Contract</span></span>
                    </div>

                    <div class="welcome-badge">
                        <i class="fas fa-circle" style="font-size:0.5rem;"></i>
                        ODC Management Portal
                    </div>

                    <h2>Sign in to your account</h2>
                    <p class="sub">Manage shifts, manpower, and services from one dashboard.</p>

                    @if (session('status'))
                        <div class="alert-session">
                            <i class="fas fa-check-circle"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <label class="form-label-custom" for="email">Email address</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope input-icon"></i>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                                autofocus
                                autocomplete="username"
                                class="{{ $errors->has('email') ? 'is-error' : '' }}"
                            >
                        </div>
                        @if ($errors->has('email'))
                            <div class="error-msg">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <!-- Password -->
                        <label class="form-label-custom" for="password">Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                                class="{{ $errors->has('password') ? 'is-error' : '' }}"
                            >
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                        @if ($errors->has('password'))
                            <div class="error-msg">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif

                        <!-- Remember + forgot -->
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <label class="remember-check">
                                <input type="checkbox" name="remember" id="remember_me">
                                Remember me
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign in to ODC
                        </button>
                    </form>

                    <div class="divider">or new to ODC?</div>

                    <div class="register-options">
                        <a href="{{ route('manpower.form') }}">
                            <i class="fas fa-hard-hat"></i> Register as Worker
                        </a>
                        <a href="{{ route('company.form') }}">
                            <i class="fas fa-building"></i> Register Company
                        </a>
                    </div>

                    <p class="text-center mt-4" style="font-size:0.78rem;color:#94a3b8;">
                        &copy; {{ date('Y') }} ODC Management &middot; All rights reserved
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>