@extends('admin.auth-layouts.app')

@section('title') Conductor List @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Conductor List</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
            <a href="{{ route('conductors.create') }}" class="btn btn-primary mb-3">Add New Conductor</a>
<table id="example1" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" aria-describedby="example1_info">
    <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th>Allotted Bus</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conductors as $conductor)
            <tr>
                <td>{{ $conductor->user->name }}</td>
                <td>{{ $conductor->user->email }}</td>
                <td>{{ $conductor->bus->name }}</td>
                <td>
                    <a href="{{ route('conductors.edit', $conductor->id) }}" class="btn btn-warning">Edit</a>
                    <!-- <form action="{{ route('conductors.destroy', $conductor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> -->
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