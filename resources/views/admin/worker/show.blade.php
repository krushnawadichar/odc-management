@extends('admin.layouts.main')

@section('title', 'Worker Details - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white">Worker Details</h4>
                    <a href="javascript:history.back()" class="btn btn-light btn-sm">
                        <i class="ti ti-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            @if($worker->profile_image)
                                <img src="{{ asset('storage/' . $worker->profile_image) }}" 
                                     alt="Profile" 
                                     class="img-fluid rounded-circle border shadow"
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-circle mx-auto border shadow" 
                                     style="width: 200px; height: 200px; font-size: 4rem;">
                                    {{ strtoupper(substr($worker->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-9">
                            <h3 class="mb-0">{{ $worker->full_name }}</h3>
                            <div class="mt-2">
                                @php
                                    $skills = $worker->skills ?? [];
                                    if($worker->other_skill) {
                                        $skills[] = $worker->other_skill;
                                    }
                                @endphp
                                {{-- @foreach($skills as $skill) --}}
                                    <span class="badge bg-info me-1 p-2">$skill</span>
                                {{-- @endforeach --}}
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Personal Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th style="width: 40%;">Email:</th>
                                                    <td>{{ $worker->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ $worker->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth:</th>
                                                    <td>{{ $worker->dob ? $worker->dob->format('d-m-Y') : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender:</th>
                                                    <td>{{ $worker->gender ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Worker Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th style="width: 40%;">Registration Date:</th>
                                                    <td>{{ $worker->registration_date->format('d-m-Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Employment Type:</th>
                                                    <td>{{ $worker->employment_type ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Salary Per Day:</th>
                                                    <td>₹{{ number_format($worker->salary_per_day, 2) }}/day</td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td>
                                                        <span class="badge bg-{{ $worker->status == 'Active' ? 'success' : 'danger' }}">
                                                            {{ $worker->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Education & Work</h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <th style="width: 40%;">Highest Education:</th>
                                                    <td>{{ $worker->highest_education ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Work Duration:</th>
                                                    <td>{{ $worker->work_duration ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Document</h6>
                                        </div>
                                        <div class="card-body">
                                            @if($worker->document_path)
                                                <p><strong>Document Name:</strong> {{ $worker->document_name ?? 'N/A' }}</p>
                                                <a href="{{ asset('storage/' . $worker->document_path) }}" 
                                                   target="_blank" 
                                                   class="btn btn-info">
                                                    <i class="ti ti-file"></i> View Document
                                                </a>
                                            @else
                                                <p class="text-muted mb-0">No document uploaded</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">{{ $worker->address ?? 'No address provided' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('worker.list') }}" class="btn btn-secondary">
                            <i class="ti ti-list"></i> Back to List
                        </a>
                        <a href="{{ route('admin.edit.worker', $worker->id) }}" class="btn btn-warning">
                            <i class="ti ti-pencil"></i> Edit
                        </a>
                        <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this worker?')">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection