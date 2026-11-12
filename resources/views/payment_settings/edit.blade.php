@extends('admin.auth-layouts.app')

@section('title') Add Payment Setting  @endsection

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
      <h5>Add Payment Setting</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">

     
                <form action="{{ route('payment-settings.update', $paymentSetting->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Gateway Name</label>
                    <select name="gateway" id="gateway" class="form-control" required>
                        <option value="">--Select--</option>
                        <option value="easebuzz" @if($paymentSetting->gateway=='easebuzz') selected @endif>easebuzz</option>
                        <option value="cashfree" @if($paymentSetting->gateway=='cashfree') selected @endif>cashfree</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="number">Payment Mode</label>
                    <select name="mode" id="mode" class="form-control" value="" required>
                        <option value="">--Select--</option>
                        <option value="prod" @if($paymentSetting->mode=='prod') selected @endif>prod</option>
                        <option value="test" @if($paymentSetting->mode=='test') selected @endif>test</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="route_name">Key ID</label>
                    <input type="text" name="key_id" class="form-control" value="{{$paymentSetting->key_id}}" required>
                </div>
                <div class="form-group">
                    <label for="from_station_id">Key Secret</label>
                    <input type="text" name="key_secret" class="form-control" value="{{$paymentSetting->key_secret}}" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Bus</button>
            </form>
            

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