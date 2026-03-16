@extends('admin.layouts.main')

@section('title', 'Company List - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3 mx-5 mt-4">
                    <div class="">
                        <h5 class="mb-0">Company List</h5>
                    </div>
                    <div class="my-3">
                        <a href="{{ route('company.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-2"></i>Add New Company
                        </a>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="card-body">
                    <form method="GET" action="{{ route('company.list') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Search by name, email, reg no..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="ti ti-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="verification_status" class="form-select">
                                    <option value="">All Verification</option>
                                    <option value="Pending" {{ request('verification_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Verified" {{ request('verification_status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="Rejected" {{ request('verification_status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="company_type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="Private Limited Company" {{ request('company_type') == 'Private Limited Company' ? 'selected' : '' }}>Private Ltd</option>
                                    <option value="Public Limited Company" {{ request('company_type') == 'Public Limited Company' ? 'selected' : '' }}>Public Ltd</option>
                                    <option value="LLP" {{ request('company_type') == 'LLP' ? 'selected' : '' }}>LLP</option>
                                    <option value="Partnership" {{ request('company_type') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('company.list') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="custom-datatable table table-hover">
                            <thead>
                                <tr>
                                    <th width="40px">
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                    </th>
                                    <th>Company</th>
                                    <th>Registration No.</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Verification</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input row-checkbox" value="{{ $company->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($company->company_logo)
                                                <img src="{{ asset('storage/'.$company->company_logo) }}" 
                                                     alt="logo" 
                                                     class="rounded-circle me-2" 
                                                     style="width: 35px; height: 35px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 35px; height: 35px;">
                                                    <span class="text-white text-uppercase">{{ substr($company->company_name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <strong>{{ $company->company_name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $company->industry_sector ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $company->registration_number }}</td>
                                    <td>
                                        {{ $company->contact_person_name }}
                                        <br>
                                        <small class="text-muted">{{ $company->contact_person_designation ?? 'N/A' }}</small>
                                    </td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if($company->verification_status == 'Verified')
                                            <span class="badge bg-success">Verified</span>
                                            @if($company->verified_at)
                                                <br>
                                                <small class="text-muted">{{ $company->verified_at->format('d/m/Y') }}</small>
                                            @endif
                                        @elseif($company->verification_status == 'Rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($company->status == 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('company.show', $company->id) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="View">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('company.edit', $company->id) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    title="Delete"
                                                    onclick="confirmDelete({{ $company->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $company->id }}" 
                                              action="{{ route('company.delete', $company->id) }}" 
                                              method="POST" 
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="ti ti-building" style="font-size: 48px;"></i>
                                            <p class="mt-2">No companies found.</p>
                                            <a href="{{ route('company.create') }}" class="btn btn-primary btn-sm">
                                                Add New Company
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <!-- <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $companies->firstItem() ?? 0 }} to {{ $companies->lastItem() ?? 0 }} of {{ $companies->total() }} entries
                        </div>
                        <div>
                            {{ $companies->links() }}
                        </div>
                    </div> -->

                    <!-- Bulk Actions -->
                    <div class="mt-3" id="bulkActions" style="display: none;">
                        <hr>
                        <div class="d-flex align-items-center">
                            <span class="me-3"><span id="selectedCount">0</span> companies selected</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="bulkVerify()">
                                    <i class="ti ti-check"></i> Verify Selected
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkDelete()">
                                    <i class="ti ti-trash"></i> Delete Selected
                                </button>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="clearSelection()">
                                Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Form -->
<form id="bulk-delete-form" action="{{ route('company.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="company_ids" id="bulk_delete_ids">
</form>

<!-- Bulk Verify Form -->
<form id="bulk-verify-form" action="{{ route('company.bulk-verify') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="company_ids" id="bulk_verify_ids">
    <input type="hidden" name="verification_status" value="Verified">
</form>
@endsection

@push('scripts')
<script>
    // Select All functionality
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
        updateBulkActions();
    });

    // Individual checkbox change
    document.querySelectorAll('.row-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateBulkActions();
            
            // Update select all checkbox
            const totalCheckboxes = document.querySelectorAll('.row-checkbox').length;
            const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked').length;
            const selectAll = document.getElementById('selectAll');
            
            if (selectAll) {
                selectAll.checked = totalCheckboxes === checkedCheckboxes;
                selectAll.indeterminate = checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes;
            }
        });
    });

    // Update bulk actions visibility
    function updateBulkActions() {
        const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        
        if (checkedCheckboxes.length > 0) {
            bulkActions.style.display = 'block';
            selectedCount.textContent = checkedCheckboxes.length;
        } else {
            bulkActions.style.display = 'none';
        }
    }

    // Clear selection
    function clearSelection() {
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.getElementById('selectAll').checked = false;
        document.getElementById('selectAll').indeterminate = false;
        updateBulkActions();
    }

    // Confirm single delete
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this company? This action cannot be undone.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Bulk delete
    function bulkDelete() {
        const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        if (checkedCheckboxes.length === 0) {
            alert('Please select at least one company.');
            return;
        }

        if (confirm('Are you sure you want to delete ' + checkedCheckboxes.length + ' selected companies? This action cannot be undone.')) {
            const ids = Array.from(checkedCheckboxes).map(cb => cb.value);
            document.getElementById('bulk_delete_ids').value = JSON.stringify(ids);
            document.getElementById('bulk-delete-form').submit();
        }
    }

    // Bulk verify
    function bulkVerify() {
        const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        if (checkedCheckboxes.length === 0) {
            alert('Please select at least one company.');
            return;
        }

        if (confirm('Are you sure you want to verify ' + checkedCheckboxes.length + ' selected companies?')) {
            const ids = Array.from(checkedCheckboxes).map(cb => cb.value);
            document.getElementById('bulk_verify_ids').value = JSON.stringify(ids);
            document.getElementById('bulk-verify-form').submit();
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateBulkActions();
    });
</script>
@endpush