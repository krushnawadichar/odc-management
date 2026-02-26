@include('layouts.header')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4" data-aos="fade-up">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h2 class="fw-bold text-center" style="color: #0b2b40;">
                        <i class="fas fa-building me-2" style="color: #f97316;"></i>
                        Register Your Company
                    </h2>
                    <p class="text-center text-secondary">Find skilled manpower for your projects</p>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('company.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Company Name</label>
                                <input type="text" name="company_name" class="form-control form-control-lg rounded-pill @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" required>
                                @error('company_name') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Contact Person</label>
                                <input type="text" name="contact_person" class="form-control form-control-lg rounded-pill @error('contact_person') is-invalid @enderror" value="{{ old('contact_person') }}" required>
                                @error('contact_person') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-pill @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Company Address</label>
                                <input type="text" name="address" class="form-control form-control-lg rounded-pill @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                                @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Required Manpower Count</label>
                                <input type="number" name="required_manpower" class="form-control form-control-lg rounded-pill @error('required_manpower') is-invalid @enderror" value="{{ old('required_manpower') }}" required>
                                @error('required_manpower') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Required Date</label>
                                <input type="date" name="required_date" class="form-control form-control-lg rounded-pill @error('required_date') is-invalid @enderror" value="{{ old('required_date') }}" required>
                                @error('required_date') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Skills Required</label>
                                <input type="text" name="skills_required" class="form-control form-control-lg rounded-pill @error('skills_required') is-invalid @enderror" value="{{ old('skills_required') }}" placeholder="e.g. plumbing, painting, electrical" required>
                                @error('skills_required') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Additional Notes</label>
                                <textarea name="notes" class="form-control rounded-4 @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                                @error('notes') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-lg w-100 rounded-pill" style="background: #f97316; color: white;">
                                    <i class="fas fa-paper-plane me-2"></i> Post Requirement
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')