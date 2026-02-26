<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | ODC · One Day Contract</title>
    <!-- Bootstrap 5 + icons + font + aos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #f5f7fb; overflow-x: hidden; }
        .navbar-brand img { height: 42px; width: auto; margin-right: 10px; }
        .nav-link-custom { font-weight: 500; color: #1e293b !important; margin: 0 0.5rem; position: relative; transition: 0.2s; }
        .nav-link-custom:hover { color: #f97316 !important; }
        .nav-link-custom::after { content: ''; position: absolute; width: 0%; height: 2px; bottom: -2px; left: 0; background-color: #f97316; transition: 0.3s; }
        .nav-link-custom:hover::after { width: 100%; }
        .register-btn { background: #f97316; color: white !important; border-radius: 40px; padding: 0.5rem 1.5rem !important; font-weight: 600; border: 2px solid #f97316; transition: 0.3s; }
        .register-btn:hover { background: white; color: #f97316 !important; border: 2px solid #f97316; }
        .page-header {
            background: linear-gradient(135deg, #0a2a38 0%, #1d4b63 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
        }
        .footer { background-color: #0b1c28; color: #cbd5e1; padding: 3rem 0 1.8rem; border-top-left-radius: 3rem; border-top-right-radius: 3rem; margin-top: 4rem; }
        .badge-skill { background-color: #f0f3f7; color: #1e293b; font-weight: 500; padding: 0.4rem 1rem; border-radius: 30px; transition: 0.2s; }
        .badge-skill:hover { background-color: #f97316; color: white; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="https://placehold.co/55x55/f97316/white?text=ODC" alt="ODC">
            <span class="fw-bold fs-4" style="color: #0b2b40;">OneDay<span style="color: #f97316;">Contract</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarODC">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarODC">
            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"> Home</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('workers') ? 'active' : '' }}" href="{{ route('workers') }}"> Workers</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('companies') ? 'active' : '' }}" href="{{ route('companies') }}"> Companies</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}"> About</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}"> Contact</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('manpower.form') }}" class="btn register-btn"><i class="far fa-user"></i> Register Manpower</a>
                <a href="{{ route('company.form') }}" class="btn register-btn"><i class="fas fa-briefcase"></i> Register Company</a>
            </div>
        </div>
    </div>
</nav>