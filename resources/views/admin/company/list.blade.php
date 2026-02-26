@extends('admin.layouts.main')

@section('title', 'Calendar - ODC Management')

@section('content')
              <div class="card">
                <h5 class="card-header">Select</h5>
                <div class="table-responsive p-5">
                  <table class="custom-datatable table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                      </tr>
                    </thead>
<tbody>
  @for ($i = 1; $i <= 100; $i++)
    <tr>
      <td>
        <input type="checkbox" class="form-check-input">
      </td>
      <td>test1</td>
      <td>test2</td>
      <td>test3</td>
      <td>test4</td>
      <td>test5</td>
      <td>test6</td>
      <td>test7</td>
    </tr>
  @endfor
</tbody>


                  </table>
                </div>
              </div>
@endsection

@push('scripts')

@endpush