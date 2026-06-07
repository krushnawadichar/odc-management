@extends('admin.layouts.main')

@section('title', 'work List - ODC Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="d-flex justify-content-between align-items-center mx-4 mt-4 mb-3">
                        <h4 class="mb-0">Work List</h4>

                        <a href="{{ route('work.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-2"></i>
                            Add New Work
                        </a>
                    </div>`

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}

                                <button type="button" class="btn-close" data-bs-dismiss="alert">
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>work Title</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>work Type</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($work as $key => $work)

                                        <tr>    

                                            <td>
                                                {{ $key + 1 }}
                                            </td>

                                            <td>
                                                <strong>
                                                    {{ $work->work_title }}
                                                </strong>

                                                <br>

                                                <small class="text-muted">
                                                    Posted {{ $work->created_at->diffForHumans() }}
                                                </small>
                                            </td>

                                            <td>
                                                {{ $work->company->userData->name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $work->location ?? 'N/A' }}
                                            </td>
                                            
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $work->work_type ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                ₹{{ number_format($work->salary_per_day ?? 0) }}
                                            </td>

                                            <td>
                                                @if($work->status == 'Active')
                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route('work.show', $work->id) }}" class="btn btn-sm btn-info"
                                                    title="View">

                                                    <i class="ti ti-eye"></i>
                                                </a>

                                                <a href="{{ route('work.edit', $work->id) }}" class="btn btn-sm btn-warning"
                                                    title="Edit">

                                                    <i class="ti ti-edit"></i>
                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="8" class="text-center py-5">

                                                <i class="ti ti-briefcase" style="font-size:60px;">
                                                </i>

                                                <h5 class="mt-3">
                                                    No works Found
                                                </h5>

                                                <p class="text-muted">
                                                    Start by creating your first work posting.
                                                </p>

                                                <a href="{{ route('work.create') }}" class="btn btn-primary">

                                                    Add New Work
                                                </a>

                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        {{-- @if(isset($works) && method_exists($works, 'links'))
                        <div class="mt-4">
                            {{ $works->links() }}
                        </div>
                        @endif --}}

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection