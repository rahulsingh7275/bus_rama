@extends('admin.auth-layouts.app')

@section('title') Payment Settings  @endsection

@section('css')
<style>
  /* Ensure that the table is responsive and allows horizontal scrolling */
  .table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling */
    white-space: nowrap; /* Prevents text wrapping */
  }

  /* Ensures that the text doesn't wrap within the table cells */
  table th, table td {
    white-space: nowrap; /* Prevent text wrapping */
  }

  /* Optional: Adjusting the width of the table to force horizontal scrolling */
  table {
    table-layout: auto; /* Let the table take as much width as needed */
    width: 100%; /* Optional: Full width table */
  }
</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Payment Settings</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">

      <!-- <a href="{{ route('payment-settings.create') }}" class="btn btn-primary mb-3">Add New Payment Gateway</a> -->
      <table id="example" class="table table-striped">
          <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th>SN#</th>
                <th>Gateway</th>
                <th>Mode</th>
                <th>Key ID</th>
                <th>Key Secret</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
        @foreach($settings as $index=>$setting)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $setting->gateway }}</td>
                <td>{{ $setting->mode }}</td>
                <td>{{ $setting->key_id }}</td>
                <td>{{ $setting->key_secret }}</td>
                {{--<td>
                    <a href="{{ route('payment-settings.edit', $setting->id) }}" class="btn btn-sm btn-success" style="margin-bottom: 5px;">Edit</a>
                    <form action="{{ route('payment-settings.destroy', $setting->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </td>--}}
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
</div>
</div>


@endsection

@section('scripts')
<script>

$(function () {
  $("#example").DataTable({
      layout: {
          topStart: {
              buttons: ['excel', 'pdf', 'print']
          }
      }
  });
  });
</script>
@endsection