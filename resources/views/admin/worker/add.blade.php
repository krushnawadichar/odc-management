@extends('admin.layouts.main')

@section('title', isset($worker) ? 'Edit Worker - ODC Management' : 'Add New Worker - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3 mx-5">
                    <div class="">
                        <h5 class="mb-0">{{ isset($worker) ? 'Edit Worker' : 'Add New Worker' }}</h5>
                    </div>
                    <div class="my-3 m">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
                <hr/>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ isset($worker) ? route('workers.update', $worker->id) : route('workers.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="workerForm">
                        @csrf
                        @if(isset($worker))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Personal Information Section -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Personal Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="first_name" 
                                       class="form-control @error('first_name') is-invalid @enderror" 
                                       value="{{ old('first_name', $worker->first_name ?? '') }}" 
                                       placeholder="Enter first name"
                                       required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="last_name" 
                                       class="form-control @error('last_name') is-invalid @enderror" 
                                       value="{{ old('last_name', $worker->last_name ?? '') }}" 
                                       placeholder="Enter last name"
                                       required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $worker->email ?? '') }}" 
                                       placeholder="Enter email address"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Phone Number <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone', $worker->phone ?? '') }}" 
                                       placeholder="Enter phone number"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <input type="date" 
                                       name="dob" 
                                       class="form-control @error('dob') is-invalid @enderror" 
                                       value="{{ old('dob', isset($worker) && $worker->dob ? $worker->dob->format('Y-m-d') : '') }}">
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Gender</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender', $worker->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $worker->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $worker->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Profile Image</label>
                                <input type="file" 
                                       name="profile_image" 
                                       class="form-control @error('profile_image') is-invalid @enderror"
                                       accept="image/*"
                                       id="profileImage">
                                <small class="text-muted">Allowed: jpeg, png, jpg, gif (Max: 2MB)</small>
                                @error('profile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if(isset($worker) && $worker->profile_image)
                                    <div class="mt-2" id="currentImage">
                                        <p class="mb-1">Current Image:</p>
                                        <img src="{{ asset('storage/' . $worker->profile_image) }}" 
                                             alt="Profile" 
                                             style="max-height: 80px; border-radius: 5px;">
                                    </div>
                                @endif
                                <div class="mt-2" id="imagePreview" style="display: none;">
                                    <p class="mb-1">New Image Preview:</p>
                                    <img src="" alt="Preview" style="max-height: 80px; border-radius: 5px;">
                                </div>
                            </div>

                            <!-- Skills Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Skills Information</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Skills (Select Multiple)</label>
                                <select name="skills[]" 
                                        class="form-select @error('skills') is-invalid @enderror" 
                                        multiple 
                                        size="5"
                                        id="skillsSelect">
                                    @foreach($skillsList as $skill)
                                        @php
                                            $selected = false;
                                            if(isset($worker) && $worker->skills) {
                                                $workerSkills = is_array($worker->skills) ? $worker->skills : json_decode($worker->skills, true);
                                                $selected = in_array($skill, $workerSkills ?? []);
                                            }
                                        @endphp
                                        <option value="{{ $skill }}" {{ $selected ? 'selected' : '' }}>{{ $skill }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Hold Ctrl/Cmd to select multiple skills</small>
                                @error('skills')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="otherSkillDiv" style="{{ (isset($worker) && $worker->other_skill) || old('other_skill') ? '' : 'display: none;' }}">
                                <label class="form-label fw-bold">Other Skill (Specify)</label>
                                <input type="text" 
                                       name="other_skill" 
                                       class="form-control @error('other_skill') is-invalid @enderror" 
                                       value="{{ old('other_skill', $worker->other_skill ?? '') }}" 
                                       placeholder="Enter other skill">
                                @error('other_skill')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Worker Details Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Worker Details</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Registration Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       name="registration_date" 
                                       class="form-control @error('registration_date') is-invalid @enderror" 
                                       value="{{ old('registration_date', isset($worker) && $worker->registration_date ? $worker->registration_date->format('Y-m-d') : date('Y-m-d')) }}"
                                       required>
                                @error('registration_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Employment Type</label>
                                <select name="employment_type" class="form-select @error('employment_type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="Full-Time" {{ old('employment_type', $worker->employment_type ?? '') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                    <option value="Part-Time" {{ old('employment_type', $worker->employment_type ?? '') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                    <option value="Contract" {{ old('employment_type', $worker->employment_type ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="Intern" {{ old('employment_type', $worker->employment_type ?? '') == 'Intern' ? 'selected' : '' }}>Intern</option>
                                </select>
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Salary Per Day</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" 
                                           step="0.01" 
                                           name="salary_per_day" 
                                           class="form-control @error('salary_per_day') is-invalid @enderror" 
                                           value="{{ old('salary_per_day', $worker->salary_per_day ?? '') }}"
                                           placeholder="0.00">
                                    <span class="input-group-text">/day</span>
                                </div>
                                @error('salary_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Active" {{ old('status', $worker->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ old('status', $worker->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Education & Work Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Education & Work Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Highest Education</label>
                                <input type="text" 
                                       name="highest_education" 
                                       class="form-control @error('highest_education') is-invalid @enderror" 
                                       value="{{ old('highest_education', $worker->highest_education ?? '') }}" 
                                       placeholder="e.g., B.Sc, MBA, 12th Pass, etc.">
                                @error('highest_education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Work Duration</label>
                                <input type="text" 
                                       name="work_duration" 
                                       class="form-control @error('work_duration') is-invalid @enderror" 
                                       value="{{ old('work_duration', $worker->work_duration ?? '') }}" 
                                       placeholder="e.g., 2 years, 6 months, etc.">
                                <small class="text-muted">How long will worker give time to company</small>
                                @error('work_duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Document Name</label>
                                <input type="text" 
                                       name="document_name" 
                                       class="form-control @error('document_name') is-invalid @enderror" 
                                       value="{{ old('document_name', $worker->document_name ?? '') }}" 
                                       placeholder="e.g., ID Proof, Resume, Certificate">
                                @error('document_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Document Upload</label>
                                <input type="file" 
                                       name="document_path" 
                                       class="form-control @error('document_path') is-invalid @enderror"
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                       id="documentFile">
                                <small class="text-muted">Allowed: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
                                @error('document_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if(isset($worker) && $worker->document_path)
                                    <div class="mt-2" id="currentDocument">
                                        <p class="mb-1">Current Document:</p>
                                        <a href="{{ asset('storage/' . $worker->document_path) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-info">
                                            <i class="ti ti-file"></i> View Document
                                        </a>
                                        @if($worker->document_name)
                                            <small class="d-block text-muted mt-1">{{ $worker->document_name }}</small>
                                        @endif
                                    </div>
                                @endif
                                <div class="mt-2" id="documentPreview" style="display: none;">
                                    <p class="mb-1">New Document:</p>
                                    <span class="badge bg-success" id="documentName"></span>
                                </div>
                            </div>

                            <!-- Address Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Address Information</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea name="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          rows="3"
                                          placeholder="Enter full address">{{ old('address', $worker->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('worker.list') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                    <button type="reset" class="btn btn-light">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn {{ isset($worker) ? 'btn-warning' : 'btn-primary' }}">
                                        {{ isset($worker) ? 'Update Worker' : 'Save Worker' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show/hide other skill input based on selection
    // document.getElementById('skillsSelect')?.addEventListener('change', function(e) {
    //     const selectedOptions = Array.from(this.selectedOptions).map(opt => opt.value);
    //     const otherSkillDiv = document.getElementById('otherSkillDiv');
        
    //     if (selectedOptions.includes('Other')) {
    //         otherSkillDiv.style.display = 'block';
    //     } else {
    //         otherSkillDiv.style.display = 'none';
    //         document.querySelector('input[name="other_skill"]').value = '';
    //     }
    // });

    // Image preview functionality
    document.getElementById('profileImage')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        const currentImage = document.getElementById('currentImage');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
                if (currentImage) {
                    currentImage.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            previewImg.src = '';
            if (currentImage) {
                currentImage.style.display = 'block';
            }
        }
    });

    // Document preview functionality
    document.getElementById('documentFile')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('documentPreview');
        const documentName = document.getElementById('documentName');
        const currentDocument = document.getElementById('currentDocument');
        
        if (file) {
            documentName.textContent = file.name;
            preview.style.display = 'block';
            if (currentDocument) {
                currentDocument.style.display = 'none';
            }
        } else {
            preview.style.display = 'none';
            documentName.textContent = '';
            if (currentDocument) {
                currentDocument.style.display = 'block';
            }
        }
    });

    // Phone number validation
    document.querySelector('input[name="phone"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+\-\s]/g, '');
    });

    // Salary validation
    document.querySelector('input[name="salary_per_day"]')?.addEventListener('input', function(e) {
        if (this.value < 0) {
            this.value = 0;
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Other is selected on page load
        const skillsSelect = document.getElementById('skillsSelect');
        if (skillsSelect) {
            const selectedOptions = Array.from(skillsSelect.selectedOptions).map(opt => opt.value);
            const otherSkillDiv = document.getElementById('otherSkillDiv');
            
            if (selectedOptions.includes('Other')) {
                otherSkillDiv.style.display = 'block';
            }
        }
    });
</script>
@endpush