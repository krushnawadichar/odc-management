@extends('admin.layouts.main')

@section('title', 'Company Details - ODC Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3 mx-5 mt-4">
                    <div class="">
                        <h5 class="mb-0">Company Details</h5>
                    </div>
                    <div class="my-3">
                        <a href="{{ route('company.list') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
                <hr/>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-warning me-2">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $company->id }})">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Company Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Company Name:</th>
                                            <td>{{ $company->company_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Registration Number:</th>
                                            <td>{{ $company->registration_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $company->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ $company->phone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Founded Year:</th>
                                            <td>{{ $company->founded_year ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @if($company->status == 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Contact Person Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Name:</th>
                                            <td>{{ $company->contact_person_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation:</th>
                                            <td>{{ $company->contact_person_designation ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ $company->contact_person_email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ $company->contact_person_phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Address Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Address:</th>
                                            <td>{{ $company->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country:</th>
                                            <td>{{ $company->country_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>State:</th>
                                            <td>{{ $company->state_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>City:</th>
                                            <td>{{ $company->city_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Postal Code:</th>
                                            <td>{{ $company->postal_code }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($company->document)
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Document</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Document Name:</th>
                                            <td>{{ $company->document_name ?? 'Document' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Document:</th>
                                            <td>
                                                <a href="{{ asset('storage/' . $company->document) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="ti ti-file"></i> View Document
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="delete-form-{{ $company->id }}" 
      action="{{ route('company.delete', $company->id) }}" 
      method="POST" 
      style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this company? This action cannot be undone.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
@endsection