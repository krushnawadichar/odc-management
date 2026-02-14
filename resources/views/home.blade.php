<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODC · One Day Contract · complete management</title>
    <!-- Bootstrap 5 + icons + font + aos (animation) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- AOS (animate on scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #f5f7fb; overflow-x: hidden; }

        /* navbar */
        .navbar-brand img { height: 42px; width: auto; margin-right: 10px; }
        .nav-link-custom { font-weight: 500; color: #1e293b !important; margin: 0 0.5rem; position: relative; transition: 0.2s; }
        .nav-link-custom:hover { color: #f97316 !important; }
        .nav-link-custom::after { content: ''; position: absolute; width: 0%; height: 2px; bottom: -2px; left: 0; background-color: #f97316; transition: 0.3s; }
        .nav-link-custom:hover::after { width: 100%; }
        .register-btn { background: #f97316; color: white !important; border-radius: 40px; padding: 0.5rem 1.5rem !important; font-weight: 600; border: 2px solid #f97316; transition: 0.3s; }
        .register-btn:hover { background: white; color: #f97316 !important; border: 2px solid #f97316; }

        /* hero */
        .hero-section {
            background: radial-gradient(ellipse at 30% 40%, #1d4b63, #0a2a38);
            color: white;
            padding: 4.5rem 0 5rem;
            border-bottom-left-radius: 3rem;
            border-bottom-right-radius: 3rem;
            margin-bottom: 3rem;
            box-shadow: 0 25px 40px -15px rgba(0,40,60,0.3);
        }
        .hero-title { font-weight: 800; font-size: 3.2rem; letter-spacing: -0.02em; line-height: 1.2; }
        .hero-subtitle { font-size: 1.2rem; opacity: 0.9; max-width: 550px; }
        .btn-odc-primary { background: #f97316; border: none; border-radius: 50px; padding: 0.7rem 2rem; font-weight: 600; box-shadow: 0 8px 18px #f9731640; transition: 0.2s; }
        .btn-odc-primary:hover { background: #e9600c; transform: scale(1.05); box-shadow: 0 12px 22px #f9731670; }
        .btn-odc-outline { border: 2px solid white; background: transparent; border-radius: 50px; padding: 0.7rem 2rem; font-weight: 600; transition: 0.2s; }
        .btn-odc-outline:hover { background: white; color: #0b2b40; transform: scale(1.05); }

        /* section background colors (varied per section) */
        .section-manpower { background-color: #ffffff; border-radius: 2.5rem; padding: 2.5rem 1.5rem; box-shadow: 0 15px 30px -10px #d9e2ef; }
        .section-companies { background: linear-gradient(115deg, #f0f5fe 0%, #e9f0fa 100%); border-radius: 2.5rem; padding: 2.5rem 1.5rem; }
        .section-services { background: #ffffff; border-radius: 2.5rem; padding: 2.5rem 1.5rem; box-shadow: inset 0 -2px 10px rgba(0,0,0,0.02); }
        .section-testimonials { background: #0f2a36; border-radius: 3rem; padding: 3rem 1.8rem; color: white; }
        .section-cta { background: linear-gradient(145deg, #f97316, #fd8b3a); border-radius: 3rem; padding: 3.5rem 2rem; color: white; }

        /* cards with subtle animation */
        .card-manpower, .card-company, .service-card, .testimonial-card { border: none; border-radius: 1.8rem; box-shadow: 0 15px 30px -12px rgba(0,0,0,0.1); transition: all 0.25s ease; background: white; }
        .card-manpower:hover, .card-company:hover, .service-card:hover { transform: translateY(-10px) scale(1.01); box-shadow: 0 25px 35px -14px #f9731660; }
        .service-card { background: #fef9f2; border: 1px solid #ffe5cd; }
        .badge-skill { background-color: #f0f3f7; color: #1e293b; font-weight: 500; padding: 0.4rem 1rem; border-radius: 30px; transition: 0.2s; }
        .badge-skill:hover { background-color: #f97316; color: white; }

        /* testimonial */
        .testimonial-card { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: white; }
        .testimonial-card img { width: 60px; height: 60px; border-radius: 60px; object-fit: cover; border: 3px solid #f97316; }

        /* footer */
        .footer { background-color: #0b1c28; color: #cbd5e1; padding: 3rem 0 1.8rem; border-top-left-radius: 3rem; border-top-right-radius: 3rem; margin-top: 4rem; }

        /* flash message */
        .flash-message { border-radius: 100px; background: #d1e7dd; color: #0f5132; padding: 0.8rem 2rem; border: 1px solid #a3cfbb; }

        /* floating animation for icons */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }
        .service-icon-lg { animation: float 5s infinite ease-in-out; background: #fff4e5; width: 85px; height: 85px; border-radius: 30px; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #f97316; }
        .service-icon-lg:hover { animation: none; transform: scale(1.05); background: #f97316; color: white; transition: 0.3s; }

        /* additional polish */
        .text-small { font-size: 0.9rem; }
        .btn-outline-warning:hover i { color: white; }
        a { text-decoration: none; }
        .section-header { font-weight: 700; color: #0b2b40; letter-spacing: -0.02em; }
        .bg-white-10 { background: rgba(255,255,255,0.1); }
        .footer ul { padding-left: 0; }
        .footer ul li { list-style: none; }
    </style>
</head>
<body>

<!-- ======================= NAVBAR (about, contact us added) ===================== -->
<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="https://placehold.co/55x55/f97316/white?text=ODC" alt="ODC">
            <span class="fw-bold fs-4" style="color: #0b2b40;">OneDay<span style="color: #f97316;">Contract</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarODC" aria-controls="navbarODC" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarODC">
            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#home"> Home</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#workers"> Workers</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#companies"> Companies</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#about"> About</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#contact"> Contact</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('manpower.form') }}" class="btn register-btn"><i class="far fa-user"></i> Register Manpower</a>
                <a href="{{ route('company.form') }}" class="btn register-btn"><i class="fas fa-briefcase"></i> Register Company</a>
            </div>
        </div>
    </div>
</nav>

<!-- ======================= HERO ===================== -->
<section class="hero-section" id="home" data-aos="fade-down">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                <h1 class="hero-title">One day contract <br>management, evolved.</h1>
                <p class="hero-subtitle my-4">ODC manages everything — from skilled manpower to property services, equipment rental, and urgent staffing. One platform, one-day commitment.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('manpower.form') }}" class="btn btn-odc-primary"><i class="fas fa-user-plus me-2"></i>I'm a worker</a>
                    <a href="{{ route('company.form') }}" class="btn btn-odc-outline"><i class="fas fa-building me-2"></i>I need manpower</a>
                </div>
                <div class="mt-4 d-flex gap-4 flex-wrap">
                    <span><i class="fas fa-check-circle text-warning"></i> 700+ daily workers</span>
                    <span><i class="fas fa-check-circle text-warning"></i> 240+ companies</span>
                    <span><i class="fas fa-check-circle text-warning"></i> property & rental hub</span>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center" data-aos="fade-left" data-aos-delay="200">
                <i class="fas fa-handshake" style="font-size: 12rem; color: rgba(255,255,255,0.2);"></i>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- FLASH MESSAGE (if any) -->
    @if(session('success'))
        <div class="flash-message d-flex align-items-center mb-5 shadow-sm" data-aos="zoom-in">
            <i class="fas fa-check-circle me-2 fs-5"></i> {{ session('success') }}
        </div>
    @endif

    <!-- ========== AVAILABLE MANPOWER (section-manpower background) ========== -->
    <div class="section-manpower mb-5" id="workers" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #0b2b40;"><i class="fas fa-hard-hat me-2" style="color: #f97316;"></i>Available Manpower</h2>
            <a href="#" class="text-decoration-none fw-semibold" style="color:#f97316;">view all <i class="fas fa-arrow-right"></i></a>
        </div>

        @if(count($manpowers) > 0)
            <div class="row g-4">
                @foreach($manpowers as $index => $m)
                    <div class="col-md-6 col-lg-4" data-aos="flip-left" data-aos-delay="{{ min($index * 50, 300) }}">
                        <div class="card card-manpower p-3 h-100 border-0">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-3 me-3" style="width: 55px; height: 55px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-cog fs-3" style="color: #f97316;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-0">{{ $m->name }}</h5>
                                    <span class="text-secondary"><i class="far fa-calendar-alt me-1"></i>{{ $m->available_date }}</span>
                                </div>
                            </div>
                            <div class="mb-2">
                                @php $skills = explode(',', $m->skills); @endphp
                                @foreach($skills as $skill)
                                    <span class="badge-skill me-1 mb-1 d-inline-block">#{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                            <div class="mt-2"><button class="btn btn-sm btn-outline-warning rounded-pill px-4"><i class="fas fa-phone me-1"></i>quick contact</button></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-light border text-center py-4">No manpower available at the moment. Check again later.</div>
        @endif
    </div>

    <!-- ========== LATEST COMPANIES (section-companies background) ========== -->
    <div class="section-companies mb-5" id="companies" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #0b2b40;"><i class="fas fa-building me-2" style="color: #f97316;"></i>Latest Companies / Requests</h2>
            <a href="#" class="text-decoration-none fw-semibold" style="color:#f97316;">explore <i class="fas fa-arrow-right"></i></a>
        </div>

        @if(count($companies) > 0)
            <div class="row g-4">
                @foreach($companies as $idx => $c)
                    <div class="col-md-6 col-lg-4" data-aos="flip-right" data-aos-delay="{{ min($idx * 50, 300) }}">
                        <div class="card card-company p-3 h-100 border-0">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-store-alt fs-2" style="color:#0b2b40;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semibold mb-0">{{ $c->company_name }}</h5>
                                    <span class="text-secondary"><i class="fas fa-users me-1"></i>Need: {{ $c->required_manpower }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <span><i class="far fa-calendar-check me-1 text-primary"></i>{{ $c->required_date }}</span>
                                <span class="badge bg-warning bg-opacity-25 text-dark rounded-pill px-3 py-1">open</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-light border text-center py-4">No companies registered yet. Be the first!</div>
        @endif
    </div>

    <!-- ========== ODC MANAGEMENT SERVICES (6 core services, property, rental etc - FOCUS ODC manages) ========== -->
    <div class="section-services mb-5" id="services" data-aos="fade-up">
        <div class="text-center mb-5">
            <span class="badge bg-dark text-white px-4 py-2 rounded-pill">ODC MANAGED SERVICES</span>
            <h2 class="section-header display-6 fw-bold mt-3" style="color:#0b2b40;">We manage everything — one day, one contract</h2>
            <p class="text-secondary col-lg-7 mx-auto">From property management to equipment rental, cleaning, moving, handyman, and event staffing – all under ODC supervision, with same‑day execution.</p>
        </div>

        <div class="row g-4">
            <!-- service 1: property management (ODC focus) -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="0">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-building"></i></div>
                    <h4 class="fw-bold">Property management</h4>
                    <p class="text-secondary">ODC handles tenant check‑ins, maintenance coordination, and daily oversight for residential & commercial properties.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
            <!-- service 2: rental service (tools/equipment managed) -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="80">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-tools"></i></div>
                    <h4 class="fw-bold">Equipment rental</h4>
                    <p class="text-secondary">Rent machinery, tools, or event gear by the day. ODC manages delivery, pickup, and maintenance.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
            <!-- service 3: deep cleaning (managed teams) -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="160">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-broom"></i></div>
                    <h4 class="fw-bold">Deep cleaning</h4>
                    <p class="text-secondary">Industrial, office or post‑construction cleaning — ODC supplies fully equipped teams.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
            <!-- service 4: moving & relocation -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="40">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-truck"></i></div>
                    <h4 class="fw-bold">Moving & relocation</h4>
                    <p class="text-secondary">One‑day moving crews with trucks, insurance, and ODC supervisor — apartment or office shifts.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
            <!-- service 5: handyman services -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="120">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-wrench"></i></div>
                    <h4 class="fw-bold">Handyman & repairs</h4>
                    <p class="text-secondary">Electrical, plumbing, carpentry — ODC certified craftsmen, fully managed dispatch.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
            <!-- service 6: event staffing -->
            <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="service-card card h-100 p-4">
                    <div class="service-icon-lg mb-3"><i class="fas fa-glass-cheers"></i></div>
                    <h4 class="fw-bold">Event staffing</h4>
                    <p class="text-secondary">Bartenders, hosts, security — ODC manages scheduling, uniforms, and backup.</p>
                    <span class="text-warning fw-semibold mt-2">managed by ODC <i class="fas fa-arrow-right ms-1"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== TESTIMONIALS section (new, with background) ========== -->
    <div class="section-testimonials mb-5" id="about" data-aos="fade-right">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white">Trusted by companies & workers</h2>
            <p class="text-white-50">What they say about ODC management</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="50">
                <div class="testimonial-card card p-4 h-100">
                    <i class="fas fa-quote-left fa-2x mb-2" style="color:#f97316;"></i>
                    <p>"ODC managed our entire office move — 6 staff, all equipment, done in 8 hours. Unbelievable."</p>
                    <div class="d-flex align-items-center mt-3">
                        <img src="https://placehold.co/60x60/f97316/white?text=JD" alt="avatar">
                        <div class="ms-3"><span class="fw-bold">J. Deacon</span><br><small>Facility manager, Renovate Inc</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="100">
                <div class="testimonial-card card p-4 h-100">
                    <i class="fas fa-quote-left fa-2x mb-2" style="color:#f97316;"></i>
                    <p>"Rented a mini-excavator through ODC, they delivered, trained my guy, and picked up. Zero stress."</p>
                    <div class="d-flex align-items-center mt-3">
                        <img src="https://placehold.co/60x60/f97316/white?text=MS" alt="avatar">
                        <div class="ms-3"><span class="fw-bold">M. Soriano</span><br><small>Landscaper</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up" data-aos-delay="150">
                <div class="testimonial-card card p-4 h-100">
                    <i class="fas fa-quote-left fa-2x mb-2" style="color:#f97316;"></i>
                    <p>"As a worker, ODC gives me steady one‑day gigs — property management, cleaning, always paid same day."</p>
                    <div class="d-flex align-items-center mt-3">
                        <img src="https://placehold.co/60x60/f97316/white?text=LT" alt="avatar">
                        <div class="ms-3"><span class="fw-bold">L. Tshabalala</span><br><small>ODC craftswoman</small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== CTA / about ODC management ========== -->
    <div class="section-cta mb-5 text-center" id="contact" data-aos="zoom-in">
        <h2 class="fw-bold display-6">Managed by ODC, delivered in one day.</h2>
        <p class="opacity-90 col-lg-7 mx-auto">From property to rental, we coordinate, insure and supervise. You just confirm.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="#" class="btn btn-light rounded-pill px-5 py-2 fw-semibold"><i class="fas fa-calendar-alt"></i> Request service</a>
            <a href="#" class="btn btn-outline-light rounded-pill px-5 py-2 fw-semibold"><i class="fas fa-phone-alt"></i> Contact us</a>
        </div>
    </div>

    <!-- about / contact quick info (extra) -->
    <div class="row my-4 g-4" data-aos="fade-up">
        <div class="col-md-6">
            <div class="bg-white p-4 rounded-4 d-flex gap-3 shadow-sm">
                <i class="fas fa-map-pin fa-2x" style="color:#f97316;"></i>
                <div><span class="fw-bold">ODC head office</span><br> 142 Bree Street, Cape Town · open 7am-8pm</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white p-4 rounded-4 d-flex gap-3 shadow-sm">
                <i class="fas fa-envelope fa-2x" style="color:#f97316;"></i>
                <div><span class="fw-bold">contact@odc.management</span><br> +27 (0) 21 555 7788 · 24/7 dispatch</div>
            </div>
        </div>
    </div>
</div>

<!-- ======================= FOOTER ======================= -->
<footer class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://placehold.co/45x45/f97316/white?text=ODC" alt="logo small" style="height: 40px;">
                    <span class="fw-bold fs-5 text-white ms-2">OneDayContract</span>
                </div>
                <p class="small">Complete one-day management — manpower, property, rental, cleaning, moving, handyman, events. All managed by ODC.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white-50"><i class="fab fa-facebook-f fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-linkedin-in fs-5"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-instagram fs-5"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold text-white">For workers</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('manpower.form') }}" class="text-secondary">Register as manpower</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary">Find shifts</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary">Safety guidelines</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold text-white">For companies</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('company.form') }}" class="text-secondary">Post a shift</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary">Managed services</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary">Pricing</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold text-white">Subscribe</h6>
                <div class="input-group">
                    <input type="email" class="form-control form-control-sm bg-dark border-secondary text-white" placeholder="Email">
                    <button class="btn btn-sm btn-warning" type="button">Join</button>
                </div>
                <p class="small text-secondary mt-2">Updates on managed services & shifts.</p>
            </div>
        </div>
        <hr class="border-secondary opacity-25 my-4">
        <div class="row small text-secondary">
            <div class="col-md-6">&copy; 2025 ODC Management. All rights reserved.</div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-secondary me-3">Privacy</a>
                <a href="#" class="text-secondary me-3">Terms</a>
                <a href="#" class="text-secondary">Cookies</a>
            </div>
        </div>
        <p class="small text-center text-secondary mt-4 opacity-50"><i class="fas fa-crown"></i> ODC manages everything · one day contract</p>
    </div>
</footer>

<!-- scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: false, mirror: true, offset: 20 });
</script>
</body>
</html>