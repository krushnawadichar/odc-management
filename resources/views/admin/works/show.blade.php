@extends('admin.layouts.main')

@section('title', 'Work Details - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="d-flex justify-content-between align-items-center mx-4 mt-4 mb-3">

                    <h4 class="mb-0">
                        Work Details
                    </h4>

                    <a href="{{ route('work.list') }}"
                       class="btn btn-outline-secondary">
                        <i class="ti ti-arrow-left me-2"></i>
                        Back
                    </a>

                </div>

                <hr>

                <div class="card-body">

                    <div class="row">

                        <!-- Company -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Company
                            </label>

                            <div class="mt-1">
                                {{ $work->company->userData->name ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Work Title -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Work Title
                            </label>

                            <div class="mt-1">
                                {{ $work->work_title }}
                            </div>
                        </div>

                        <!-- No Of Workers -->
                        <div class="col-md-4 mb-4">
                            <label class="fw-bold text-muted">
                                Number Of Workers
                            </label>

                            <div class="mt-1">
                                {{ $work->no_of_workers ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Work Type -->
                        <div class="col-md-4 mb-4">
                            <label class="fw-bold text-muted">
                                Work Type
                            </label>

                            <div class="mt-1">
                                <span class="badge bg-info">
                                    {{ $work->work_type ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="col-md-4 mb-4">
                            <label class="fw-bold text-muted">
                                Experience Required
                            </label>

                            <div class="mt-1">
                                {{ $work->experience ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Salary Per Day
                            </label>

                            <div class="mt-1">
                                ₹{{ number_format($work->salary_per_day ?? 0, 2) }}
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Work Location
                            </label>

                            <div class="mt-1">
                                {{ $work->location ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Start Date
                            </label>

                            <div class="mt-1">
                                {{ $work->start_date ? $work->start_date->format('d M Y') : 'N/A' }}
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                End Date
                            </label>

                            <div class="mt-1">
                                {{ $work->end_date ? $work->end_date->format('d M Y') : 'N/A' }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Status
                            </label>

                            <div class="mt-1">
                                @if($work->status == 'Active')
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Required Skills
                            </label>

                            <div class="mt-1">
                                {{ $work->skills ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-4">
                            <label class="fw-bold text-muted">
                                Work Description
                            </label>

                            <div class="mt-2 p-3 border rounded bg-light">
                                {!! nl2br(e($work->description ?? 'N/A')) !!}
                            </div>
                        </div>

                        <!-- Created At -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Created At
                            </label>

                            <div class="mt-1">
                                {{ $work->created_at->format('d M Y h:i A') }}
                            </div>
                        </div>

                        <!-- Updated At -->
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold text-muted">
                                Last Updated
                            </label>

                            <div class="mt-1">
                                {{ $work->updated_at->format('d M Y h:i A') }}
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('work.edit', $work->id) }}"
                           class="btn btn-warning me-2">
                            <i class="ti ti-edit me-1"></i>
                            Edit
                        </a>

                        <form action="{{ route('work.delete', $work->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this work?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                <i class="ti ti-trash me-1"></i>
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection