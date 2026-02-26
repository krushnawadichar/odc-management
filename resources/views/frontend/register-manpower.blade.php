@include('layouts.header')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4" data-aos="fade-up">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h2 class="fw-bold text-center" style="color: #0b2b40;">
                        <i class="fas fa-hard-hat me-2" style="color: #f97316;"></i>
                        Register as Manpower
                    </h2>
                    <p class="text-center text-secondary">Join ODC network and get daily work opportunities</p>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('manpower.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-pill @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-pill @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ID Number / Passport</label>
                                <input type="text" name="id_number" class="form-control form-control-lg rounded-pill @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}" required>
                                @error('id_number') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Skills (comma separated)</label>
                                <input type="text" name="skills" class="form-control form-control-lg rounded-pill @error('skills') is-invalid @enderror" value="{{ old('skills') }}" placeholder="e.g. plumbing, painting, electrical" required>
                                @error('skills') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Available Date</label>
                                <input type="date" name="available_date" class="form-control form-control-lg rounded-pill @error('available_date') is-invalid @enderror" value="{{ old('available_date') }}" required>
                                @error('available_date') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Location / Area</label>
                                <input type="text" name="location" class="form-control form-control-lg rounded-pill @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                                @error('location') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Brief Bio / Experience</label>
                                <textarea name="bio" class="form-control rounded-4 @error('bio') is-invalid @enderror" rows="3">{{ old('bio') }}</textarea>
                                @error('bio') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-lg w-100 rounded-pill" style="background: #f97316; color: white;">
                                    <i class="fas fa-paper-plane me-2"></i> Register Now
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