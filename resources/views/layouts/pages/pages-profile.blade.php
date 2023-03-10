@include('layouts.header')


	<main class="content">
		<div class="row">
			<div class="card">
				<ul class="nav nav-tabs" data-bs-toggle="tabs">
					<li class="nav-item">
					<a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
					</li>
				</ul>
				<div class="card-body">
					<div class="tab-content">
						
						<div class="tab-pane show active" id="tabs-details">
							<form method="post" action="/profileedit" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="mb-3">
											<input type="hidden"  name="id" value="{{ $data->id }}">
											<label class="form-label">Name</label>
											<input type="text" class="form-control" name="name" value="{{ $data->name }}">
											<span class="text-danger">@error('name') {{ $message }}@enderror</span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="text" class="form-control" name="email" value="{{ $data->email }}" disabled>
											<span class="text-danger"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<label class="form-label">Role</label>
											<input type="text" class="form-control" name="role" value="{{ $data->role }}" disabled>
											<span class="text-danger"></span>
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Profile Image</label><br>
										<img src="{{ asset('images/' . $data->profile) }}" class="rounded" width="60" height="60"><br>
									</div>
									<div class="mb-3">
										<input type="file" class="form-control" name="profile" value="{{ $data->profile }}">
										<span class="text-danger">@error('profile') {{ $message }}@enderror</span>
									</div>
								</div>
									<button type="submit" class="btn btn-primary">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>	
	</main>
	<script src="js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.js"></script>
	<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap/bootstrap.min.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			
@include('layouts.footer')