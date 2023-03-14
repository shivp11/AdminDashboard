@include('layouts.header')

	<main class="content">
		<div>
			@if (Session::has('success'))
			<div class="alert alert-success">{{ Session::get('success') }}</div>            
			@endif
			@if (Session::has('failed'))
			<div class="alert alert-danger">{{ Session::get('failed') }}</div>            
			@endif
		</div>
		<div>
   
			<div class="page-header">
				<div class="row align-items-center">
				  <div class="col-auto">
					<img src="{{ asset('images/' . $data->profile) }}" class="rounded-circle image-previewer" width="80" height="80"><br>
					{{-- <span class="avatar avatar-md" style="background-image: url({{ 'images/DSC_0001.jpg' }})"></span> --}}
				  </div>
				  <div class="col-md-6">
					<h2 class="page-title">{{ $data->name }}</h2>
					<div class="page-subtitle">
					  <div class="row">
						<div class="col-auto">
						  <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
						  <!-- SVG icon code -->
						  <a href="#" class="text-reset">{{ $data->role }}</a>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="col " style="text-align: right">
					<input type="file" name="_userAvatarFile" id="_userAvatarFile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
					<a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('_userAvatarFile').click();">
					  <!-- Download SVG icon from http://tabler-icons.io/i/message -->
					  <!-- SVG icon code -->
					  Change Picture
					</a>
				  </div>
				</div>
			  </div>
		<br>
		</div>
		
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
									{{-- <div class="mb-3">
										<label class="form-label">Profile Image</label><br>
										<img src="{{ asset('images/' . $data->profile) }}" class="rounded image-previewer" width="60" height="60"><br>
									</div>
									<div class="mb-3">
										<input type="file" name="_userAvatarFile" id="_userAvatarFile">
										<span class="text-danger">@error('profile') {{ $message }}@enderror</span>
									</div> --}}
								</div>
									<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>	
		
	</main>
	<script src="js/app.js"></script>
	<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
	<script>
        $('#_userAvatarFile').ijaboCropTool({
			type: "POST",
			preview : '.image-previewer',
			setRatio:1,
			allowedExtensions: ['jpg', 'jpeg','png'],
			buttonsText:['CROP','QUIT'],
			buttonsColor:['#30bf7d','#ee5155', -15],
			processUrl:'{{ route("user.crop") }}',
			withCSRF:['_token','{{ csrf_token() }}'],
			onSuccess:function(message, element, status){
             alert(message);
			},
			onError:function(message, element, status){
				alert(message);
			}
		});

	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.js"></script>
	<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('/plugins/bootstrap/bootstrap.min.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			
@include('layouts.footer')