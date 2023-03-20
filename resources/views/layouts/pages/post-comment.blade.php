@include('layouts.header')
        <main class="content mt-0">
		<div class="container-fluid p-0 mt-0">
          @if (Session::has('success'))
          <div class="alert alert-success" style="width: 25%">{{ Session::get('success') }}</div>            
          @endif
          @if (Session::has('failed'))
          <div class="alert alert-success" style="width: 25%">{{ Session::get('failed') }}</div>            
          @endif
                      {{-- User Info Table --}}
                      <div class="col-xs-6 mt-0">
                        <br>
                        <table id="postData" class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="d-none">Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th class="d-none">Content</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($users as $user)
                                <tr>
                                    <td class="d-none">{{ $user->id }}</td>
                                    <td>{{ $user->post_author }}</td>
                                    <td>{{ $user->post_title }}</td>
                                    <td class="text-center"><img src="{{ asset('images/post/' . $user->post_image) }}" class="img-fluid rounded mb-2" width="100" height="100"/></td>
                                    <td class="d-none">{{ $user->post_content }}</td>
                                    <td><div class="text-center">
                                      <a href="{{ '/viewcomments/' . $user->id }}" class="btn btn-primary" type="button">View Comments</a>
                                    </div></td>
                                </tr>
                            @endforeach
                    
                            </tbody>
                        </table>
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

      <script type="text/javascript">
        $(document).ready(function(){
  
          var table = $('#postData').DataTable({
            order: [[5, 'desc']],
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "pageLength": 5,
            retrieve: true,
          });
          
          table.on('click', '.comment', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);

            $('#id3').val(data[0]);;


            
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