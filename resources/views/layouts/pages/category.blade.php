{{-- @include('layouts.header')--}}



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
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



	<link href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css " rel="stylesheet">
	<link href="{{ asset('css/app.css') }} " rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ 'dashboard' }}">
          <span class="align-middle">Dashboard</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{ 'dashboard' }}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'profile' }}">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link active" href="{{ 'userinfo' }}">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Users</span>
            </a>
					</li>

					<li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'ui-buttons' }}">
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'ui-forms' }}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'ui-cards' }}">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'ui-typography' }}">
              <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'icons' }}">
              <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
            </a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ 'charts' }}">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
            </a>
					</li>
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
                	<img src="{{ asset('images/profile-img.jpg') }}" class="avatar img-fluid rounded me-1" /> <span class="text-dark"> Shiv Patel</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ 'profile' }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Change Password</a>
                <div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav> 


            <main class="content">
				<div class="container-fluid p-0">

                    @if (Session::has('success'))
          <div class="alert alert-success">{{ Session::get('success') }}</div>            
          @endif
          @if (Session::has('failed'))
          <div class="alert alert-success">{{ Session::get('failed') }}</div>            
          @endif
                    {{-- Navbar search --}}
                    <nav class="navbar navbar-expand-lg bg-body-tertiary p-1">
                        <div class="container-fluid">
                          <h3>Post Categories</h3>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                              </li>
                            </ul>
                            <form action="" class="d-flex" role="search">
                              <input class="btn btn-primary" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_todo" type="button" value="Add Category"/></button>
                            </form>
                          </div>
                        </div>
                      </nav>
                      
                      {{-- User Info Table --}}
                      <div class="col-xs-6">
                        <br>
                        <table id="userData" class="table table-bordered table-hover">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                <tr><form action="updatedelete" method="get">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td><input type="hidden" name="name" value="{{ $user->cat_title }}">{{ $user->cat_title }}</td>
                                    <td><div class="text-center"><button class="btn btn-primary" type="submit" name="edit" value="Edit">Edit</button></div></td>
                                    <td><div class="text-center"><button  class="btn btn-danger" type="submit" name="delete" value="Delete">Delete</button></div></td>
                                </form>
                                </tr>
                            @endforeach
                    
                            </tbody>
                        </table>
                  </div>
                
                {{-- Add Category --}}
                  <div class="modal" id="modal_todo">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" action="/addcategory" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Add Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="text" name="cat_title"  placeholder="Category Name" required>
                            </div><br>
                        </div>
                  
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>

                </div>
			</main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://shivpatel.netlify.app/" target="_blank"><strong>Shiv Patel</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <script src="js/app.js"></script>
            <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js">
            let table = new DataTable('#myTable');
            </script>
            <script>$(document).ready(function () {
              $('#userData').DataTable({
                order: [[5, 'desc']],
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "pageLength": 5
              });
          });</script>
            
        </body>

        </html> 
{{-- @include('layouts.footer') --}}