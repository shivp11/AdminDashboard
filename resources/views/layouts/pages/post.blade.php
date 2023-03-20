@include('layouts.header')
            <main class="content">
              <button type="button" class="btn btn-primary mt-0 mb-3" id="open" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal_todo">
                <i data-feather="plus"></i>  Add Post
              </button>
				<div class="container-fluid p-0">

          @if (Session::has('success'))
          <div class="alert alert-success" style="width: 25%">{{ Session::get('success') }}</div>            
          @endif
          @if (Session::has('failed'))
          <div class="alert alert-success" style="width: 25%">{{ Session::get('failed') }}</div>            
          @endif
                      
                      {{-- User Info Table --}}
                      <div class="col-xs-6">
                        <br>
                        <table id="postData" class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="d-none">Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th class="d-none">Content</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                <tr>
                                    <td class="d-none">{{ $user->id }}</td>
                                    <td>{{ $user->post_author }}</td>
                                    <td>{{ $user->post_title }}</td>
                                    <td>{{ $user->post_status }}</td>
                                    <td class="text-center"><img src="{{ asset('images/post/' . $user->post_image) }}" class="img-fluid rounded mb-2" width="100" height="100"/></td>
                                    <td class="d-none">{{ $user->post_content }}</td>
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
                
                {{-- Add Post --}}
                  <div class="modal" id="modal_todo" id="myForm">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" action="/addpost" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Add Post</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" type="hidden" name="id"></div>
                            <div><input class="form-control" type="hidden" name="user_id" value="{{ $data->id }}"></div>
                            <div>
                              <label for="">Post Title</label>
                              <input class="form-control" type="text" name="post_title" placeholder="Post Title" required>
                              {{-- <span class="text-danger">@error('post_title') {{ $message }}@enderror</span></div><br> --}}
                            <div>
                              <label for="">Post Author</label>
                              <input class="form-control" type="text" name="post_author" placeholder="Post Author" value="{{ $data->name }}" readonly></div>
                              {{-- <span class="text-danger">@error('post_author') {{ $message }}@enderror</span> --}}
                              <div><label class="d-none" for="">Post Status</label></div>
                            <div>
                              <select class="d-none" name="post_status" id="post_status">
                                <option value="Pending">Approve</option>  
                                <option value="Pending">Pending</option>  
                              </select>
                            </div><br>
                            <div>
                              <label for="">Post Image</label>
                              <input class="form-control" class="form-control" type="file" name="post_image" ></div><br>
                            <div><label for="summernote">Post Content</label>
                            <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" required></textarea></div>
                            {{-- <span class="text-danger">@error('post_content') {{ $message }}@enderror</span> --}}
                          </div>
                  
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" onclick="myFunction()">Submit</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>

                </div>

                {{-- Edit Post --}}
                  <div class="modal" id="editModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" id="editForm" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Edit Post</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div><input class="form-control" id="id" type="hidden" name="id"></div><br>
                            <div><label for="">Post Title</label></div>
                            <div><input class="form-control" id="post_title" type="text" name="post_title" ></div><br>
                            <div><label for="">Post Author</label></div>
                            <div><input class="form-control" id="post_author" type="text" name="post_author"></div><br>
                            <div><label for="">Post Status</label></div>
                            <div>
                              <select name="post_status" id="post_status">
                                <option value="Approved">Approve </option>  
                                <option value="Pending">Pending</option>  
                              </select>
                            </div><br>
                            <div><label for="">Post Image</label></div>
                            <div><input class="form-control" class="form-control" type="file" name="post_image"></div><br>
                            <div><label for="summernote">Post Content</label>
                            <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"></textarea></div>
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

                {{-- Delete Post --}}
                  <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form class="form-control" id="deleteForm" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="model_title">Delete Post</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                          <input class="form-control" type="text" id="id3" name="id">
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
			</main>
      <script src="js/app.js"></script>

      <script>
        function myFunction() {
          $('myForm').trigger('reset');
        }
        </script>

      <script type="text/javascript">
        $(document).ready(function(){
  
          var table = $('#postData').DataTable({
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
  
            $('#id').val(data[0]);
            $('#post_author').val(data[1]);
            $('#post_title').val(data[2]);
            $('#post_status').val(data[3]);
            $('#post_content').val(data[5]);
  
            $('#editForm').attr('action', '/updatepost/'+data[0]);
            $('#editModal').modal('show');
            
          })
        })
        </script>
  
      <script type="text/javascript">
        $(document).ready(function(){
  
          var table = $('#postData').DataTable({
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

            $('#id3').val(data[0]);;
  
            $('#deleteForm').attr('action', '/deletepost/'+data[0]);
            $('#deleteModal').modal('show');
            
          })
        })
        </script>
  

      <script>$(document).ready(function () {
        $('#postData').DataTable({
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5,
          retrieve: true,
        });
      });</script>
@include('layouts.footer')