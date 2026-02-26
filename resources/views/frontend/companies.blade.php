@include('layouts.header')
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" data-aos="fade-right">Companies & Requirements</h1>
        <p class="lead" data-aos="fade-right" data-aos-delay="100">Find work opportunities with trusted companies</p>
    </div>
</div>

<div class="container py-4">
    <!-- Stats -->
    <div class="row mb-5 g-4" data-aos="fade-up">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <h2 class="fw-bold" style="color: #f97316;">{{ $companies->count() ?? 0 }}+</h2>
                <p class="text-secondary mb-0">Active Companies</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <h2 class="fw-bold" style="color: #f97316;">{{ $companies->sum('required_manpower') ?? 0 }}+</h2>
                <p class="text-secondary mb-0">Open Positions</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                <h2 class="fw-bold" style="color: #f97316;">24h</h2>
                <p class="text-secondary mb-0">Average Response</p>
            </div>
        </div>
    </div>

    <!-- Companies Grid -->
    <div class="row g-4">
        @forelse($companies ?? [] as $index => $company)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-building fa-2x" style="color: #0b2b40;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ $company->company_name }}</h5>
                                <span class="text-secondary small"><i class="fas fa-map-marker-alt me-1"></i>{{ $company->address ?? 'City Centre' }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-users me-2 text-warning"></i>Need: {{ $company->required_manpower }} workers</span>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Open</span>
                            </div>
                            <div class="mb-2">
                                <span class="fw-semibold">Skills required:</span>
                                @php $skills = explode(',', $company->skills_required ?? ''); @endphp
                                @foreach($skills as $skill)
                                    <span class="badge-skill me-1 d-inline-block mt-2">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary"><i class="far fa-calendar me-1"></i>By: {{ $company->required_date }}</span>
                            <button class="btn btn-sm btn-warning rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#applyModal{{ $company->id }}">
                                Apply Now <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Apply Modal -->
            <div class="modal fade" id="applyModal{{ $company->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">Apply to {{ $company->company_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control rounded-pill">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Your Skills</label>
                                    <input type="text" class="form-control rounded-pill" placeholder="e.g. plumbing, painting">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Brief Message</label>
                                    <textarea class="form-control rounded-3" rows="3" placeholder="I'm interested in this position..."></textarea>
                                </div>
                                <button class="btn btn-warning w-100 rounded-pill">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5 rounded-4">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <h4>No companies registered yet</h4>
                    <p>Be the first to post a requirement</p>
                    <a href="{{ route('company.form') }}" class="btn btn-warning rounded-pill px-4 mt-2">Register Company</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

@include('layouts.footer')