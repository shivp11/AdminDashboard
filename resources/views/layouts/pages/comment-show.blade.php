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
                                    <th>Content</th>
                                    <th class="d-none">Image</th>
                                    <th class="d-none">Content</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                    
                            @foreach ($comments as $comment)
                                <tr>
                                    <td class="d-none">{{ $comment->comment_id }}</td>
                                    <td>{{ $comment->comment_author }}</td>
                                    <td>{{ $comment->comment_content }}</td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td><div class="text-center">
                                      <button class="btn btn-danger delete" type="button">Delete</button>
                                    </td></div>
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
                          <input class="form-control" type="text" id="id3" name="comment_id">
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
      <script src="{{ asset('js/app.js') }}"></script>

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

            $('#deleteForm').attr('action', '/deletecomment/'+data[0]);
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