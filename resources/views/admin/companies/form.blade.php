@extends('admin.layouts.main')

@section('title', isset($company) ? 'Edit Company - ODC Management' : 'Add New Company - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3 mx-5 mt-4">
                    <div class="">
                        <h5 class="mb-0">{{ isset($company) ? 'Edit Company' : 'Add New Company' }}</h5>
                    </div>
                    <div class="my-3">
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

                    <form action="{{ isset($company) ? route('company.update', $company->id) : route('company.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="companyForm">
                        @csrf
                        @if(isset($company))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Company Basic Information Section -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Company Basic Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Company Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="company_name" 
                                       class="form-control @error('company_name') is-invalid @enderror" 
                                       value="{{ old('company_name', $company->company_name ?? '') }}" 
                                       placeholder="Enter company name"
                                       required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Registration Number
                                </label>
                                <input type="text" 
                                       name="registration_number" 
                                       class="form-control @error('registration_number') is-invalid @enderror" 
                                       value="{{ old('registration_number', $company->registration_number ?? '') }}" 
                                       placeholder="Enter registration number">
                                @error('registration_number')
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
                                       value="{{ old('email', $company->email ?? '') }}" 
                                       placeholder="Enter email address"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" 
                                       name="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone', $company->phone ?? '') }}" 
                                       placeholder="Enter phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Founded Year</label>
                                <input type="number" 
                                       name="founded_year" 
                                       class="form-control @error('founded_year') is-invalid @enderror" 
                                       value="{{ old('founded_year', $company->founded_year ?? '') }}" 
                                       placeholder="YYYY"
                                       min="1800"
                                       max="{{ date('Y') }}">
                                @error('founded_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Person Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Contact Person Details</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Contact Person Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="contact_person_name" 
                                       class="form-control @error('contact_person_name') is-invalid @enderror" 
                                       value="{{ old('contact_person_name', $company->contact_person_name ?? '') }}" 
                                       placeholder="Enter contact person name"
                                       required>
                                @error('contact_person_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Designation</label>
                                <input type="text" 
                                       name="contact_person_designation" 
                                       class="form-control @error('contact_person_designation') is-invalid @enderror" 
                                       value="{{ old('contact_person_designation', $company->contact_person_designation ?? '') }}" 
                                       placeholder="e.g., HR Manager, Director">
                                @error('contact_person_designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Contact Person Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       name="contact_person_email" 
                                       class="form-control @error('contact_person_email') is-invalid @enderror" 
                                       value="{{ old('contact_person_email', $company->contact_person_email ?? '') }}" 
                                       placeholder="Enter contact person email"
                                       required>
                                @error('contact_person_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Contact Person Phone <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="contact_person_phone" 
                                       class="form-control @error('contact_person_phone') is-invalid @enderror" 
                                       value="{{ old('contact_person_phone', $company->contact_person_phone ?? '') }}" 
                                       placeholder="Enter contact person phone"
                                       required>
                                @error('contact_person_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Address Information</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    Address <span class="text-danger">*</span>
                                </label>
                                <textarea name="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          rows="3"
                                          placeholder="Enter full address"
                                          required>{{ old('address', $company->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <select name="country" 
                                        id="country" 
                                        class="form-select @error('country') is-invalid @enderror" 
                                        required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" 
                                            {{ old('country', $company->country ?? '') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">
                                    State <span class="text-danger">*</span>
                                </label>
                                <select name="state" 
                                        id="state" 
                                        class="form-select @error('state') is-invalid @enderror" 
                                        required>
                                    <option value="">Select State</option>
                                    @if(isset($states))
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" 
                                                {{ old('state', $company->state ?? '') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">
                                    City <span class="text-danger">*</span>
                                </label>
                                <select name="city" 
                                        id="city" 
                                        class="form-select @error('city') is-invalid @enderror" 
                                        required>
                                    <option value="">Select City</option>
                                    @if(isset($cities))
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" 
                                                {{ old('city', $company->city ?? '') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">
                                    Postal Code <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="postal_code" 
                                       class="form-control @error('postal_code') is-invalid @enderror" 
                                       value="{{ old('postal_code', $company->postal_code ?? '') }}" 
                                       placeholder="Postal code"
                                       required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Documents Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Documents</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Document Name</label>
                                <input type="text" 
                                       name="document_name" 
                                       class="form-control @error('document_name') is-invalid @enderror" 
                                       value="{{ old('document_name', $company->document_name ?? '') }}" 
                                       placeholder="e.g., Registration Certificate, PAN Card">
                                @error('document_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Document Upload</label>
                                <input type="file" 
                                       name="document" 
                                       class="form-control @error('document') is-invalid @enderror"
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                       id="document">
                                <small class="text-muted">Allowed: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if(isset($company) && $company->document)
                                    <div class="mt-2" id="currentDocument">
                                        <p class="mb-1">Current Document:</p>
                                        <a href="{{ asset('storage/' . $company->document) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-info">
                                            <i class="ti ti-file"></i> View Document
                                        </a>
                                        @if($company->document_name)
                                            <small class="d-block text-muted mt-1">{{ $company->document_name }}</small>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Status Section -->
                            <div class="col-12 mt-3">
                                <h5 class="border-bottom pb-2 mb-3">Status</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Active" {{ old('status', $company->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ old('status', $company->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('company.list') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                    <button type="reset" class="btn btn-light">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn {{ isset($company) ? 'btn-warning' : 'btn-primary' }}">
                                        {{ isset($company) ? 'Update Company' : 'Save Company' }}
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

<!-- @push('scripts') -->
<script>
    $(document).ready(function(){

    $('#country').on('change', function(){

        alert('test');

    });

});
    // Country, State, City dependent dropdown
   $('#country').on('change', function() {
alert('test');
    var countryId = $(this).val();

    if (countryId) {

        $.ajax({
            url: "{{ route('get.states', ':countryId') }}".replace(':countryId', countryId),
            type: 'GET',
            dataType: 'json',

            success: function(data) {

                $('#state').empty().append('<option value="">Select State</option>');
                $('#city').empty().append('<option value="">Select City</option>');

                $.each(data, function(key, value) {
                    $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                });

            }
        });

    } else {

        $('#state').empty().append('<option value="">Select State</option>');
        $('#city').empty().append('<option value="">Select City</option>');

    }

});

  $('#state').change(function() {

    var stateId = $(this).val();

    if(stateId){

        $.ajax({
            url: "{{ route('get.cities', ':stateId') }}".replace(':stateId', stateId),
            type: "GET",
            dataType: "json",

            success:function(data){

                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');

                $.each(data, function(key, value){
                    $('#city').append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }

        });

    }

});

    // Document preview
    document.getElementById('document')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const currentDocument = document.getElementById('currentDocument');
        
        if (file && currentDocument) {
            currentDocument.style.display = 'none';
        } else if (!file && currentDocument) {
            currentDocument.style.display = 'block';
        }
    });

    // Phone number validation
    document.querySelector('input[name="phone"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+\-\s]/g, '');
    });

    // Contact person phone validation
    document.querySelector('input[name="contact_person_phone"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+\-\s]/g, '');
    });

    // Founded year validation
    document.querySelector('input[name="founded_year"]')?.addEventListener('input', function(e) {
        const year = parseInt(this.value);
        const currentYear = new Date().getFullYear();
        if (year < 1800) {
            this.value = 1800;
        } else if (year > currentYear) {
            this.value = currentYear;
        }
    });
</script>
<!-- @endpush -->