@extends('admin.layouts.main')

@section('title', 'Worker List - ODC Management')

@section('content')
<div class="text-end mb-3">
    <a href="{{ route('admin.add.worker') }}" class="btn btn-primary">
        <span class="ti ti-plus me-2"></span>Add Worker
    </a>
</div>

<div class="card">
    <h5 class="card-header">Worker List</h5>
    <div class="table-responsive p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="custom-datatable table table-bordered">
            <thead class="">
                <tr>
                    <th width="50">
                        <input type="checkbox" class="form-check-input" id="selectAll">
                    </th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Skills</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Reg. Date</th>
                    <th>Salary/Day</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($workers as $worker)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input worker-checkbox" value="{{ $worker->id }}">
                    </td>
                    <td>
                        @if($worker->profile_image)
                            <img src="{{ asset('storage/' . $worker->profile_image) }}" 
                                 alt="Profile" 
                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 40px; height: 40px; font-size: 18px;">
                                {{ strtoupper(substr($worker->first_name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $worker->full_name }}</td>
                    <td>
                        @php
                            $skills = $worker->skills ?? [];
                            if($worker->other_skill) {
                                $skills[] = $worker->other_skill;
                            }
                        @endphp
             
                            <span class="text-muted">N/A</span>
                   
                    </td>
                    <td>{{ $worker->email }}</td>
                    <td>{{ $worker->phone }}</td>
                    <td>{{ $worker->registration_date ? $worker->registration_date->format('d-m-Y') : 'N/A' }}</td>
                    <td>₹{{ number_format($worker->salary_per_day, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $worker->status == 'Active' ? 'success' : 'danger' }}">
                            {{ $worker->status }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <!-- View Button -->
                            <a href="{{ route('workers.show', $worker->id) }}" 
                               class="btn btn-sm btn-info text-white" 
                               title="View Details"
                               data-bs-toggle="tooltip">
                                <i class="ti ti-eye"></i>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.edit.worker', $worker->id) }}" 
                               class="btn btn-sm btn-warning text-white" 
                               title="Edit Worker"
                               data-bs-toggle="tooltip">
                                <i class="ti ti-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('workers.destroy', $worker->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this worker?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        title="Delete Worker"
                                        data-bs-toggle="tooltip">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <div class="text-muted">
                            <i class="ti ti-users" style="font-size: 48px;"></i>
                            <p class="mt-2">No workers found.</p>
                            <a href="{{ route('admin.add.worker') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="ti ti-plus me-1"></i>Add New Worker
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    // Select all checkbox functionality
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.worker-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Individual checkbox change - update select all
    document.querySelectorAll('.worker-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = document.querySelectorAll('.worker-checkbox:checked').length === document.querySelectorAll('.worker-checkbox').length;
            document.getElementById('selectAll').checked = allChecked;
        });
    });
</script>
@endpush

@push('styles')
<style>
    .d-flex.gap-1 {
        gap: 5px !important;
    }
    
    @media (max-width: 768px) {
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
</style>
@endpush
@endsection