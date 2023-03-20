@include('layouts.header')

      <main class="content p-4">
      <button type="button" class="btn btn-primary mt-0 mb-3" id="open" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal_todo">
        <i data-feather="plus"></i>  Add User
      </button>
      <div>
      @if (Session::has('success'))
      <div class="alert alert-success" style="width: 25%">{{ Session::get('success') }}
      </div>            
      @endif
      @if (Session::has('failed'))
      <div class="alert alert-danger" style="width: 25%">{{ Session::get('failed') }}</div>            
      @endif
    </div>               
      <div class="container-fluid p-0">
                      {{-- User Info Table --}}
                      <div class="col-xs-6">
                        <br>
                        <table id="userData" class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr >
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
                                <tr class="table-bordered">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="d-none">{{ $user->id }}</td>
                                    <td class="text-center"><img src="{{ asset('images/' . $user->profile) }}" class="img-fluid rounded mb-2" width="55" height="55"/></td>
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
                        <form id="form" class="form-control" action="/addAuthor" method="POST"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Add User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div>
                              <label for="">Name</label>
                              <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                              <span class="text-danger">@error('name') {{ $message }}@enderror</span>
                            </div><br>
                            <div>
                              <label for="">Email</label>
                              <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                              <span class="text-danger">@error('email') {{ $message }}@enderror</span>
                            </div><br>
                            <div><label for="">Role</label></div>
                            <div>
                              <select name="role" id="role">
                                <option value="Admin">Admin</option>  
                                <option value="Subscriber">Subscriber</option>  
                              </select>
                            </div><br>
                              <span class="text-danger">@error('role') {{ $message }}@enderror</span>
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
                        <form class="form-control" id="editForm" action="" method="post" enctype="multipart/form-data"> 
                            @csrf
                            {{-- @method('PUT') --}}
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Edit User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="text" id="name1" name="name" placeholder="Name">
                            </div><br>
                            <div><input class="form-control" type="email" id="email1" name="email" placeholder="Email">
                            </div><br>
                            <div>
                              <select name="role" id="role1">
                                <option value="Admin">Admin</option>  
                                <option value="Subscriber">Subscriber</option>  
                              </select>
                            </div><br>
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

          $('#name1').val(data[0]);
          $('#email1').val(data[1]);
          $('#role1').val(data[2]);
          // $('#profile').val(data[5]);
          
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
      <script>
      $(document).ready(function () {
        $('#userData').DataTable({
          retrieve: true,
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5
        });
      });</script>
      
@include('layouts.footer')