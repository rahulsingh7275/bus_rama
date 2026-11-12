@extends('admin.auth-layouts.app')

@section('title') Bus Pickup/Drop Points @endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      <h5>Bus Pickup/Drop Points</h5>
      <div class="card">
        <div class="card-body px-6 pb-6">
          <a href="{{ route('bus_pickup_drop_points.create') }}" class="btn btn-primary mb-3">Add Pickup/Drop Point</a>
          <div class="overflow-x-auto">
            <table id="example1" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" aria-describedby="example1_info">
              <thead class="bg-slate-200 dark:bg-slate-700">
                <tr>
                  <th>SN#</th>
                  <th>Bus Station</th>
                  <th>Point Name</th>
                  <th>Address</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pickupDropPoints as $index => $point)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $point->busStation->name }}</td>
                    <td>{{ $point->name }}</td>
                    <td>{{ $point->address }}</td>
                    <td>
                      <a href="{{ route('bus_pickup_drop_points.edit', $point->id) }}" class="btn btn-warning">Edit</a>
                      <form action="{{ route('bus_pickup_drop_points.destroy', $point->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
  $("#example1").DataTable({
    layout: {
      topStart: {
        buttons: ['excel', 'pdf', 'print']
      }
    }
  });
});
</script>
@endsection
