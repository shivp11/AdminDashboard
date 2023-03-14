
<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>IoT dashboard</title>

	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity=
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous">
</script>
	{{-- DataTable --}}
	<link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.3/af-2.5.2/b-2.3.5/b-colvis-2.3.5/b-html5-2.3.5/b-print-2.3.5/datatables.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
    <script src="{{ asset('ijaboCropTool/jquery-1.7.1.min.js') }}"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="{{ asset('css/imgareaselect.css') }}">
	<link href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css " rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.1.0/cropper.css">

	<link href="{{ asset('css/app.css') }} " rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				@if ($data->role == 'Admin')
				<a class="sidebar-brand" href="{{ '/dashboard' }}">
				<span class="align-middle">Dashboard</span>
				@else
				<a class="sidebar-brand" href="{{ '/blog' }}">
				<span class="align-middle">LaraBlog</span>
				@endif
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
					@if ($data->role == 'Admin')
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ '/dashboard' }}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>
					@endif
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ '/profile' }}">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ '/blog' }}">
			  <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Blogs</span>
			</a>
					</li>
					@if ($data->role == 'Admin')
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ '/userinfo' }}">
			  <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ '/post' }}">
			  <i class="align-middle" data-feather="aperture"></i> <span class="align-middle">Post</span>
			</a>
					</li>
					@endif
					@if ($data->role != 'Admin')
					<li class="sidebar-item">
						<a class="sidebar-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#add_post" href="{{ '/post' }}">
			  <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Add Post</span>
						</a>
					</li>
					@endif
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                	<img src="{{ asset('images/' . $data->profile) }}" class="avatar img-fluid rounded me-1 image-previewer" alt="{{ $data->name }}" /> <span class="text-dark"> {{ $data->name }}</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ '/profile' }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ '/changeform/'.$data->id }}">Change Password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ '/logout' }}">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav> 
