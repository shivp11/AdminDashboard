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
                          <h3>View Posts</h3>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                              </li>
                            </ul>
                            <form action="" class="d-flex" role="search">
                              <input class="btn btn-primary" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_todo" type="button" value="Add Post"/></button>
                            </form>
                          </div>
                        </div>
                      </nav>
                      
                      {{-- User Info Table --}}
                      <div class="col-xs-6">
                        <br>
                        <table id="postData" class="table table-bordered table-hover">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    {{-- <th>Comments</th> --}}
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                <tr><form action="updatedeletepost" method="get">
                                    <td><input type="hidden" name="id" value="{{ $user->id }}">{{ $user->id }}</td>
                                    <td><input type="hidden" name="post_author" value="{{ $user->post_author }}">{{ $user->post_author }}</td>
                                    <td><input type="hidden" name="post_title" value="{{ $user->post_title }}">{{ $user->post_title }}</td>
                                    <td><input type="hidden" name="post_status" value="{{ $user->post_status }}">{{ $user->post_status }}</td>
                                    <td class="text-center"><img src="{{ asset('images/post/' . $user->post_image) }}" class="img-fluid rounded mb-2" width="100" height="100"/></td>
                                    <input type="hidden" name="post_content" value="{{ $user->post_content }}">
                                    {{-- <td><input type="hidden" name="post_comment_count" value="{{ $user->post_comment_count }}">{{ $user->post_comment_count }}</td> --}}
                                    <td><div class="text-center"><button class="btn btn-primary" type="submit" name="editpost" value="Editpost">Edit</button></div></td>
                                    <td><div class="text-center"><button  class="btn btn-danger" type="submit" name="deletepost" value="Deletepost">Delete</button></div></td>
                                </form>
                                </tr>
                            @endforeach
                    
                            </tbody>
                        </table>
                  </div>
                
                {{-- Add Post --}}
                  <div class="modal" id="modal_todo">
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
                            <div><input class="form-control" type="hidden" name="id"></div><br>
                            <div><input class="form-control" type="text" name="post_title" placeholder="Post Title"></div><br>
                            {{-- <input class="form-control" type="text" name="cat_title" > </div> <br>--}}
                            <div><input class="form-control" type="text" name="post_author" placeholder="Post Author"></div><br>
                            <div><label for="">Post Status</label></div>
                            <div>
                              <select name="post_status" id="post_status">
                                <option value="Published">Published</option>  
                                <option value="Draft">Draft</option>  
                              </select>
                            </div><br>
                            <div><input class="form-control" class="form-control" type="file" name="post_image" required></div><br>
                            <div><label for="summernote">Post Content</label>
                            <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea></div>
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
        $('#postData').DataTable({
          order: [[5, 'desc']],
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "pageLength": 5
        });
      });</script>
@include('layouts.footer')