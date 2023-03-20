{{-- Add Post --}}
<div class="modal" id="add_post">
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
                <input class="form-control" type="text" name="post_title" placeholder="Post Title">
            </div><br>
            <div>
                <label for="">Post Author</label>
                <input class="form-control" type="text" name="post_author" placeholder="Post Author" value="{{ $data->name }} " disabled>
            </div><br>
            <div><label class="d-none" for="">Post Status</label></div>
            <div>
              <select class="d-none" name="post_status" id="post_status">
                <option value="Pending">Published</option>  
                <option value="Pending">Draft</option>  
              </select>
            </div>
            <div>
                <label for="">Post Image</label>
                <input class="form-control" type="file" name="post_image" required>
            </div><br>
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


<script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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
</body>
  </html>