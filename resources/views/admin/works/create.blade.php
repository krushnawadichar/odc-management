@extends('admin.layouts.main')

@section('title', 'Add New Work - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="d-flex justify-content-between align-items-center mb-3 mx-5">
                    <div>
                        <h5 class="mb-0">
                            {{ isset($work) ? 'Edit Work' : 'Add New Work' }}
                        </h5>
                    </div>

                    <div class="my-3">
                        <a href="{{ route('work.list') }}"
                           class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back
                        </a>
                    </div>
                </div>

                <hr>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($work) ? route('work.update', $work->id) : route('work.store') }}"
                        method="POST">

                        @csrf

                        @if(isset($work))
                            @method('PUT')
                        @endif

                        @if(isset($work))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <!-- Work Information -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">
                                    Work Information
                                </h5>
                            </div>

                            <!-- Company -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Company
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="company_id" class="form-select" required>
                                    <option value="">Select Company</option>

                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ old('company_id', $work->company_id ?? '') == $company->id ? 'selected' : '' }}>
                                            {{ $company->userData->name ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Work Title -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Work Title
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="work_title"
                                    class="form-control"
                                    value="{{ old('work_title', $work->work_title ?? '') }}"
                                    placeholder="Enter Work Title"
                                    required>
                            </div>

                            <!-- Number Of Workers -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Number Of Workers Required
                                </label>

                                <input type="number"
                                    name="no_of_workers"
                                    class="form-control"
                                    min="1"
                                    value="{{ old('no_of_workers', $work->no_of_workers ?? '') }}"
                                    placeholder="Enter Number">
                            </div>

                            <!-- Work Type -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Work Type
                                </label>

                                <select name="work_type" class="form-select">

                                    <option value="">Select Work Type</option>

                                    <option value="Construction"
                                        {{ old('work_type', $work->work_type ?? '') == 'Construction' ? 'selected' : '' }}>
                                        Construction
                                    </option>

                                    <option value="Factory"
                                        {{ old('work_type', $work->work_type ?? '') == 'Factory' ? 'selected' : '' }}>
                                        Factory
                                    </option>

                                    <option value="Housekeeping"
                                        {{ old('work_type', $work->work_type ?? '') == 'Housekeeping' ? 'selected' : '' }}>
                                        Housekeeping
                                    </option>

                                    <option value="Driver"
                                        {{ old('work_type', $work->work_type ?? '') == 'Driver' ? 'selected' : '' }}>
                                        Driver
                                    </option>

                                    <option value="Security Guard"
                                        {{ old('work_type', $work->work_type ?? '') == 'Security Guard' ? 'selected' : '' }}>
                                        Security Guard
                                    </option>

                                    <option value="Office Work"
                                        {{ old('work_type', $work->work_type ?? '') == 'Office Work' ? 'selected' : '' }}>
                                        Office Work
                                    </option>

                                </select>
                            </div>

                            <!-- Experience -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">
                                    Experience Required
                                </label>

                                <input type="text"
                                       name="experience"
                                       class="form-control"
                                       value="{{ old('experience', $work->experience ?? '') }}"
                                       placeholder="e.g. 2 Years">
                            </div>

                            <!-- Salary Per Day -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Salary Per Day
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        ₹
                                    </span>

                                    <input type="number"
                                           name="salary_per_day"
                                           class="form-control"
                                           value="{{ old('salary_per_day', $work->salary_per_day ?? '') }}"
                                           placeholder="Enter Salary">

                                    <span class="input-group-text">
                                        /Day
                                    </span>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Work Location
                                </label>

                                <input type="text"
                                       name="location"
                                       class="form-control"
                                       value="{{ old('location', $work->location ?? '') }}"
                                       placeholder="Enter Work Location">
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Start Date
                                </label>

                                <input type="date"
                                       name="start_date"
                                       class="form-control"
                                       value="{{ old('start_date', $work->start_date ?? '') }}">
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    End Date
                                </label>

                                <input type="date"
                                       name="end_date"
                                       class="form-control"
                                       value="{{ old('end_date', $work->end_date ?? '') }}">
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Status
                                </label>

                                <select name="status" class="form-select">

                                    <option value="Active"
                                        {{ old('status', $work->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="Inactive"
                                        {{ old('status', $work->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>
                            </div>

                            <!-- Skills -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Required Skills
                                </label>

                                <input type="text"
                                    name="skills"
                                    class="form-control"
                                    value="{{ old('skills', $work->skills ?? '') }}"
                                    placeholder="Mason, Electrician, Driver, Helper">
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">
                                    Work Description
                                </label>

                                <textarea name="description"
                                          rows="6"
                                          class="form-control"
                                          placeholder="Enter complete work description">{{ old('description', $work->description ?? '') }}</textarea>
                            </div>

                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>

                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('work.list') }}"
                                       class="btn btn-secondary">
                                        Cancel
                                    </a>

                                    <button type="reset"
                                            class="btn btn-light">
                                        Reset
                                    </button>

                                    <button type="submit"
                                            class="btn {{ isset($work) ? 'btn-warning' : 'btn-primary' }}">
                                        {{ isset($work) ? 'Update Work' : 'Save Work' }}
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