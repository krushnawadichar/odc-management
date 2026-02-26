@include('frontend.layouts.header')
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-right">About ODC</h1>
        <p class="lead" data-aos="fade-right" data-aos-delay="100">One Day Contract · Complete Management</p>
    </div>
</div>

<div class="container py-4">
    <!-- Our Story -->
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6" data-aos="fade-right">
            <h2 class="fw-bold display-6 mb-4">Our Story</h2>
            <p class="lead">Founded in 2020, ODC (One Day Contract) was born from a simple idea: make manpower and services available on a one-day commitment basis.</p>
            <p>We realized that businesses and individuals often need immediate help — whether it's a construction worker for a day, emergency cleaning, or last-minute event staff. Traditional agencies take days or weeks. ODC delivers within 24 hours.</p>
            <p>Today, we've grown into a complete management platform handling everything from property management to equipment rental, always with the same promise: one day, one contract, fully managed.</p>
            
            <div class="row mt-4 g-3">
                <div class="col-6">
                    <div class="bg-light p-3 rounded-4 text-center">
                        <h3 class="fw-bold text-warning">700+</h3>
                        <p class="mb-0">Workers</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-3 rounded-4 text-center">
                        <h3 class="fw-bold text-warning">240+</h3>
                        <p class="mb-0">Companies</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-3 rounded-4 text-center">
                        <h3 class="fw-bold text-warning">15k+</h3>
                        <p class="mb-0">Jobs Completed</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-light p-3 rounded-4 text-center">
                        <h3 class="fw-bold text-warning">24h</h3>
                        <p class="mb-0">Avg. Response</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <img src="https://placehold.co/600x400/f97316/white?text=ODC+Team" class="img-fluid rounded-4 shadow" alt="ODC Team">
        </div>
    </div>

    <!-- Mission & Values -->
    <div class="row g-4 mb-5">
        <div class="col-md-4" data-aos="fade-up">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <i class="fas fa-bullseye fa-3x text-warning mb-3"></i>
                <h4 class="fw-bold">Our Mission</h4>
                <p class="text-secondary">To provide reliable, same-day manpower and services with complete management, making hiring simple and stress-free.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <i class="fas fa-eye fa-3x text-warning mb-3"></i>
                <h4 class="fw-bold">Our Vision</h4>
                <p class="text-secondary">To become Africa's leading one-day contract management platform, connecting skilled workers with opportunities instantly.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <i class="fas fa-heart fa-3x text-warning mb-3"></i>
                <h4 class="fw-bold">Our Values</h4>
                <p class="text-secondary">Integrity, speed, quality, and fairness in every contract we manage.</p>
            </div>
        </div>
    </div>

    <!-- Team -->
    <h2 class="fw-bold text-center mb-4" data-aos="fade-up">Our Leadership Team</h2>
    <div class="row g-4">
        <div class="col-md-4" data-aos="zoom-in">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <img src="https://placehold.co/150x150/f97316/white?text=JD" class="rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                <h5 class="fw-bold">John Deacon</h5>
                <p class="text-warning mb-2">Founder & CEO</p>
                <p class="small text-secondary">20+ years in construction and manpower management</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <img src="https://placehold.co/150x150/f97316/white?text=SS" class="rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                <h5 class="fw-bold">Sarah Smith</h5>
                <p class="text-warning mb-2">Operations Director</p>
                <p class="small text-secondary">Former facility manager, expert in property services</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <img src="https://placehold.co/150x150/f97316/white?text=MK" class="rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                <h5 class="fw-bold">Mike Khumalo</h5>
                <p class="text-warning mb-2">Head of Partnerships</p>
                <p class="small text-secondary">Building relationships with companies across SA</p>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')