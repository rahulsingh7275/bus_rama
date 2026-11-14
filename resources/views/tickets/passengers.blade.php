@extends('admin.auth-layouts.app')

@section('title') Passengers @endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      <h5 class="mb-3">Passengers</h5>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="passengers-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Registration Date &amp; Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach($passengers as $passenger)
                  <tr>
                    <td></td>
                    <td>{{ $passenger->name }}</td>
                    <td>{{ $passenger->email }}</td>
                    <td>{{ $passenger->mobile ?? '-' }}</td>
                    <td>{{ optional($passenger->created_at)->format('d-m-Y h:i A') ?? '-' }}</td>
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
  $("#passengers-table").DataTable({
    responsive: true,
    columnDefs: [{
      targets: 0,
      searchable: false,
      orderable: false,
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    }],
    layout: {
      topStart: {
        buttons: ['excel', 'pdf', 'print']
      }
    }
  });
});
</script>
@endsection
