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
                    <li class="mb-2"><a href="{{ route('manpower.form') }}" class="text-secondary text-decoration-none">Register as manpower</a></li>
                    <li class="mb-2"><a href="{{ route('workers') }}" class="text-secondary text-decoration-none">Find shifts</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Safety guidelines</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold text-white">For companies</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('company.form') }}" class="text-secondary text-decoration-none">Post a shift</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-secondary text-decoration-none">Managed services</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Pricing</a></li>
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
                <a href="#" class="text-secondary text-decoration-none me-3">Privacy</a>
                <a href="#" class="text-secondary text-decoration-none me-3">Terms</a>
                <a href="#" class="text-secondary text-decoration-none">Cookies</a>
            </div>
        </div>
        <p class="small text-center text-secondary mt-4 opacity-50"><i class="fas fa-crown"></i> ODC manages everything · one day contract</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: false, mirror: true, offset: 20 });
</script>
@stack('scripts')
</body>
</html>