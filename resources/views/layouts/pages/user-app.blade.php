@include('layouts.header')

            <main class="content">
				<div class="container-fluid p-0">

          @if (Session::has('success'))
          <div class="alert alert-success">{{ Session::get('success') }}</div>            
          @endif
          @if (Session::has('failed'))
          <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
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
                            <thead class="table-primary text-center">
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Role</th>
                                  <th class="d-none">Id</th>
                                  <th>Image</th>
                                  <th class="d-none">Show Image</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="d-none">{{ $user->id }}</td>
                                    <td class="text-center"><img src="{{ asset('images/' . $user->profile) }}" class="img-fluid rounded mb-2" width="80" height="80"/></td>
                                    <td class="d-none">{{ $user->profile }}</td>
                                    <td><div class="text-center">
                                      <a href="#" class="btn btn-primary edit" type="button">Edit</a>
                                    </div></td>
                                    <td><div class="text-center">
                                      <a href="#" class="btn btn-danger delete" type="button">Delete</a>
                                    </div></td>
                                    
                                </tr>
                            @endforeach
                    
                            </tbody>
                        </table>
                  </div>
                
                {{-- Add User --}}
                  <div class="modal" id="modal_todo">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" action="/addAuthor" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Add User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="text" name="name" placeholder="Name" required>
                              <span class="text-danger">@error('name') {{ $message }}@enderror</span>
                            </div><br>
                            <div><input class="form-control" type="email" name="email" placeholder="Email" required>
                              <span class="text-danger">@error('email') {{ $message }}@enderror</span>
                            </div><br>
                            <div><input class="form-control" type="text" name="role"  placeholder="Role" required>
                              <span class="text-danger">@error('role') {{ $message }}@enderror</span>
                            </div><br>
                            {{-- <div><input class="form-control" type="password" name="password" placeholder="Password" >

                            </div><br>
                            <div><input class="form-control" type="file" name="profile" ><br>
                        </div> --}}
                  
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

                {{-- Edit User --}}
                  <div class="modal" id="editModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" id="editForm" action="{{ '/updates/' }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            {{-- @method('PUT') --}}
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Edit User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="text" id="name" name="name" placeholder="Name">
                            </div><br>
                            <div><input class="form-control" type="email" id="email" name="email" placeholder="Email">
                            </div><br>
                            <div>
                              <select name="role" id="role">
                                <option value="Admin">Admin</option>  
                                <option value="Subscriber">Subscriber</option>  
                              </select>
                            </div><br>
                            {{-- <div class="mb-3">
                              <label class="form-label">Profile Image</label><br>
                              <img src="{{ asset('images/' ) }}" id="profile" class="rounded" width="60" height="60"><br>
                            </div> --}}
                            <div><input class="form-control" type="file" name="profile"><br>
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

                {{-- delete User --}}
                  <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" id="deleteForm" action="" method="post" enctype="multipart/form-data"> 
                            @csrf
                            {{-- @method('PUT') --}}
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Delete User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input class="form-control" type="hidden" id="id" name="id">
                            <p>Are you Sure !!! you want to Delete this User ?</p>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </main>
              <script src="js/app.js"></script> 

      <script type="text/javascript">
      $(document).ready(function(){

        var table = $('#userData').DataTable({
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5,
          retrieve: true,
        });
        
        table.on('click', '.edit', function(){
          $tr = $(this).closest('tr');
          if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
          }
          var data = table.row($tr).data();
          console.log(data);

          $('#name').val(data[0]);
          $('#email').val(data[1]);
          $('#role').val(data[2]);
          $('#profile').val(data[5]);

          $('#editForm').attr('action', '/updates/'+data[3]);
          $('#editModal').modal('show');
          
        })
      })
      </script>

      {{-- Delete User Script --}}
      <script type="text/javascript">
      $(document).ready(function(){

        var table = $('#userData').DataTable({
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5,
          retrieve: true,
        });
        
        table.on('click', '.delete', function(){
          $tr = $(this).closest('tr');
          if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
          }
          var data = table.row($tr).data();
          console.log(data);

          $('#id').val(data[3]);

          $('#deleteForm').attr('action', '/deleteuser/'+data[3]);
          $('#deleteModal').modal('show');
          
        })
      })
      </script>
      <script>$(document).ready(function () {
        $('#userData').DataTable({
          retrieve: true,
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5
        });
      });</script>
      
@include('layouts.footer')