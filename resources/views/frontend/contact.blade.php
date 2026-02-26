@include('layouts.header')
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-right">Contact Us</h1>
        <p class="lead" data-aos="fade-right" data-aos-delay="100">We're here to help 24/7</p>
    </div>
</div>

<div class="container py-4">
    <div class="row g-5">
        <!-- Contact Info -->
        <div class="col-lg-5" data-aos="fade-right">
            <h2 class="fw-bold mb-4">Get in touch</h2>
            <p class="lead mb-4">Have questions? Need immediate assistance? Our team is ready to help.</p>
            
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fas fa-phone-alt fa-2x text-warning"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Call us</h6>
                    <p class="mb-0">+27 (0) 21 555 7788</p>
                    <small class="text-secondary">24/7 dispatch available</small>
                </div>
            </div>
            
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fas fa-envelope fa-2x text-warning"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Email us</h6>
                    <p class="mb-0">contact@odc.management</p>
                    <small class="text-secondary">Response within 2 hours</small>
                </div>
            </div>
            
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fas fa-map-marker-alt fa-2x text-warning"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Visit us</h6>
                    <p class="mb-0">142 Bree Street, Cape Town</p>
                    <small class="text-secondary">Open Mon-Sat, 7am-8pm</small>
                </div>
            </div>
            
            <div class="d-flex gap-3 mt-4">
                <a href="#" class="btn btn-outline-warning rounded-circle p-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-outline-warning rounded-circle p-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="btn btn-outline-warning rounded-circle p-3"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="btn btn-outline-warning rounded-circle p-3"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="col-lg-7" data-aos="fade-left">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <h3 class="fw-bold mb-4">Send us a message</h3>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="#" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Your Name</label>
                            <input type="text" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Your Email</label>
                            <input type="email" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" class="form-control form-control-lg rounded-pill" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject</label>
                            <select class="form-select form-select-lg rounded-pill">
                                <option>General Inquiry</option>
                                <option>Manpower Request</option>
                                <option>Partnership</option>
                                <option>Support</option>
                                <option>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea class="form-control rounded-4" rows="5" placeholder="How can we help you?" required></textarea>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-lg w-100 rounded-pill" style="background: #f97316; color: white;">
                                <i class="fas fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Map -->
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3310.284647647452!2d18.4173!3d-33.9181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc676b4a0b0b0b%3A0x2b0b0b0b0b0b0b0b!2sCape%20Town!5e0!3m2!1sen!2sza!4v1620000000000!5m2!1sen!2sza" 
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
    
    <!-- FAQ -->
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <h2 class="fw-bold text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How quickly can you provide manpower?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We can provide manpower within 24 hours of your request. For urgent needs, we have an emergency dispatch service that can get workers to you within 2-4 hours.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Are your workers insured?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, all ODC workers are fully insured and covered by our liability insurance. We also verify their skills and background before onboarding.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            What areas do you serve?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We currently operate in Cape Town and surrounding areas. We're expanding to Johannesburg and Durban in the coming months.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')