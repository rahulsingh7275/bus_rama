@extends('admin.auth-layouts.app')

@section('title') Add Subscription Plans @endsection

@section('css')
<style>

</style>
@endsection

@include('notifications.notification')

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- content area starts -->

      <h4 class="m-0">Add Subscription Plans</h4>

      <div class="card">
          <div class="card-header">
            Add Subscription Plan
          </div>
          <div class="card-body table-responsive">
        
          <form method="POST">

            <div class="row">
              <div class="col-md-6 form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label>Description</label>
                <textarea name="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label>Additional Description</label>
                <textarea name="additional_description" cols="30" rows="5" class="form-control">{{ old('additional_description') }}</textarea>
                @error('additional_description')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label>Duration (in month)</label>
                <input type="number" name="duration" class="form-control" value="{{ old('duration') }}">
                @error('duration')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Amount Text</label>
                <select name="amount_text" class="form-control">
                    <!-- <option value="">Select</option> -->
                    <option value="/month" {{ old('amount_text') == '/month' ? 'selected' : '' }}>Per Month</option>
                    <!-- <option value="/year" {{ old('amount_text') == '/year' ? 'selected' : '' }}>Per Year</option> -->
                </select>
                @error('amount_text')
                    <div class="text-danger">* {{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="row">
              <input type="hidden" name="short_description" value=" ">
              <div class="col-md-4 form-group">
                <input type="submit" name="Add Subscription Plan" class="btn btn-success">
                <a href="{{url('admin/subscription-plans')}}" class="btn btn-primary">Back</a>
              </div>
            </div>
            
          </form>
          
          </div>
          </div>
      <!-- content area ends -->
    
    </div>
  </div>
</div>

@endsection
