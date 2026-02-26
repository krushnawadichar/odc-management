@include('layouts.header')

<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-right">Available Workers</h1>
        <p class="lead" data-aos="fade-right" data-aos-delay="100">Find skilled manpower for your next project</p>
    </div>
</div>

<div class="container py-4">
    <!-- Search & Filter -->
    <div class="row mb-4" data-aos="fade-up">
        <div class="col-md-8 mx-auto">
            <div class="input-group">
                <input type="text" class="form-control form-control-lg rounded-start-pill" placeholder="Search by skills or location...">
                <button class="btn btn-warning rounded-end-pill px-4" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <!-- Workers Grid -->
    <div class="row g-4">
        @forelse($manpowers ?? [] as $index => $worker)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-scale">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-user-cog fs-2" style="color: #f97316;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ $worker->name }}</h5>
                                <span class="text-secondary small"><i class="fas fa-map-marker-alt me-1"></i>{{ $worker->location ?? 'City Centre' }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            @php $skills = explode(',', $worker->skills); @endphp
                            @foreach($skills as $skill)
                                <span class="badge-skill me-1 mb-1 d-inline-block">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success"><i class="far fa-calendar-check me-1"></i>Available: {{ $worker->available_date }}</span>
                            <button class="btn btn-sm btn-outline-warning rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#contactModal{{ $worker->id }}">
                                <i class="fas fa-phone me-1"></i>Contact
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Modal -->
            <div class="modal fade" id="contactModal{{ $worker->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">Contact {{ $worker->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><i class="fas fa-phone me-2 text-warning"></i> {{ $worker->phone }}</p>
                            <p><i class="fas fa-envelope me-2 text-warning"></i> {{ $worker->email }}</p>
                            <hr>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Send a quick message</label>
                                    <textarea class="form-control rounded-3" rows="3" placeholder="I'd like to discuss a job opportunity..."></textarea>
                                </div>
                                <button class="btn btn-warning w-100 rounded-pill">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5 rounded-4">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <h4>No workers available at the moment</h4>
                    <p>Check back later or register as a worker</p>
                    <a href="{{ route('manpower.form') }}" class="btn btn-warning rounded-pill px-4 mt-2">Register as Worker</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link rounded-pill mx-1" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link rounded-pill mx-1" href="#">1</a></li>
                <li class="page-item"><a class="page-link rounded-pill mx-1" href="#">2</a></li>
                <li class="page-item"><a class="page-link rounded-pill mx-1" href="#">3</a></li>
                <li class="page-item"><a class="page-link rounded-pill mx-1" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<style>
.hover-scale:hover { transform: translateY(-5px); transition: 0.3s; }
</style>

@include('layouts.footer')