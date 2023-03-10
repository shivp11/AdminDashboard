@include('layouts.header')

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
                          <h3>User Information</h3>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                                {{-- <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_todo">Add User</a> --}}
                              </li>
                            </ul>
                            <form action="" class="d-flex" role="search">
                              {{-- <input class="form-control me-2" name="search" value="{{ $search }}" type="search" placeholder="Search" aria-label="Search"> --}}
                              {{-- <button class="btn btn-outline-success" type="submit" >Search</button> --}}
                              <input class="btn btn-primary" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_todo" type="button" value="Add User"/></button>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                <tr><form action="updatedelete" method="get">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td><input type="hidden" name="name" value="{{ $user->name }}">{{ $user->name }}</td>
                                    <td><input type="hidden" name="email" value="{{ $user->email }}">{{ $user->email }}</td>
                                    <td><input type="hidden" name="role" value="{{ $user->role }}">{{ $user->role }}</td>
                                    <td class="text-center"><img src="{{ asset('images/' . $user->profile) }}" class="img-fluid rounded mb-2" width="100" height="100"/></td>
                                    <td><div class="text-center"><button class="btn btn-primary" type="submit" name="edit" value="Edit">Edit</button></div></td>
                                    <td><div class="text-center"><button  class="btn btn-danger" type="submit" name="delete" value="Delete">Delete</button></div></td>
                                </form>
                                </tr>
                            @endforeach
                    
                            </tbody>
                        </table>
                  </div>
                
                {{-- Add User --}}
                  <div class="modal" id="modal_todo">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" action="/adduser" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Add User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="text" name="name" placeholder="Name" required>
                            </div><br>
                            <div><input class="form-control" type="email" name="email" placeholder="Email">
                            </div><br>
                            <div><input class="form-control" type="text" name="role"  placeholder="Role" required>
              
                            </div><br>
                            <div><input class="form-control" type="password" name="password" placeholder="Password" required>

                            </div><br>
                            <div><input class="form-control" type="file" name="profile" required><br>
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
              <script src="js/app.js"></script>
      <script>$(document).ready(function () {
        $('#userData').DataTable({
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5
        });
      });</script>
@include('layouts.footer')