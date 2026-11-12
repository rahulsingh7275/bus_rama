@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 113px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  @include('notifications.notification')

          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       
		<div class="login-box" style="margin: auto;">
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
				<p class="login-box-msg t"><h4 class="m-0">Password Change</h4></p>

				<form action="" method="post">
					@csrf
					<div class="input-group mb-3">
						<input type="password" name="current_password" class="form-control" placeholder="Old Password">
						<div class="input-group-append">
							<div class="input-group-text">
							<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="new_password" class="form-control" placeholder="New Password">
						<div class="input-group-append">
							<div class="input-group-text">
							<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
					<input type="password" name="new_confirm_password" class="form-control" placeholder="Confirm Password">
					<div class="input-group-append">
						<div class="input-group-text">
						<span class="fas fa-lock"></span>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Change password</button>
					</div>
					<div class="col-md-12 text-danger">
						<br>
						Note : Password must be contain
						<ol>
							<li>Min 8 chars long</li>
							<li>Min One Digit</li>
							<li>Min One Uppercase</li>
							<li>Min One Lower Case</li>
							<li>Min One Special Chars</li>
						</ol>
					</div>
					<!-- /.col -->
					</div>
				</form>

				
				</div>
				<!-- /.login-card-body -->
			</div>
			</div>
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection