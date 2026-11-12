<!-- https://sweetalert2.github.io/#download -->
<script src="{{asset('admin_asset/sweetalert2.js')}}"></script>



@if (\Session::has('error'))
<script>
Swal.fire(
  'FAILED!',
  "{!! \Session::get('error') !!}",
  'error'
)
</script>
@endif
@if (\Session::has('success'))
<script>
Swal.fire(
  'SUCCESS!',
  "{!! \Session::get('success') !!}",
  'success'
)
</script>
@endif

{{--
@if (\Session::has('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! \Session::get('error') !!}
</div>
@endif
--}}


{{--

@if($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{$errors->first()}}
</div>
@endif


@if (\Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! \Session::get('success') !!}
</div>
@endif

@if (\Session::has('message'))
    <div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! \Session::get('message') !!}
    </div>
@endif
--}}