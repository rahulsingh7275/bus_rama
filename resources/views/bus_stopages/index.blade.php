@extends('admin.auth-layouts.app')

@section('title') Sub Stopage List @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Sub Stopage List</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
            <a href="{{ route('bus_stopages.create') }}" class="btn btn-primary mb-3">Add New Bus Stopage</a>
            <table id="example1" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" aria-describedby="example1_info">
              <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th>SN#</th>
                <th>Stopage Name</th>
                <th>Bus Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stopages as $index=>$stopage)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $stopage->name }}</td>
                <td>{{ $stopage->bus->name }}</td>
                <td>
                    <a href="{{ route('bus_stopages.edit', $stopage->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('bus_stopages.destroy', $stopage->id) }}" method="POST" class="d-inline">
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