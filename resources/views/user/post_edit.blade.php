@include('blog.include.header')
            <main class="content">
				<div class="container">
                    <div class="title"><h1>Edit User</h1></div>
                    <br>
                    <form action="{{ 'updatepost/'.$id }}" method="post" enctype="multipart/form-data"> 
                        @csrf
                   
                        <div><input class="form-control" type="hidden" name="id" value="{{ $id }}"></div><br>
                        <div><input class="form-control" type="text" name="post_title" value="{{ $post_title }}" placeholder="Post Title"></div><br>
                        <div><input class="form-control" type="text" name="post_author" value="{{ $post_author }}" placeholder="Post Author"></div><br>
                        {{-- <div><input class="form-control" type="text" name="post_status" value="{{ $post_status }}" placeholder="Post Status"></div><br> --}}
                        <div><label for="">Post Status</label></div>
                        <div>
                            <select name="post_status" id="post_status">
                              <option value="Published">Published</option>  
                              <option value="Draft">Draft</option>  
                            </select>
                        </div><br>
                        <div><input class="form-control" class="form-control" type="file" name="post_image"></div><br>
                        <div><label for="summernote">Post Content</label>
                        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" value="{{ $post_content }}">{{ $post_content }}</textarea>
                        </div><br>
              
                    <!-- Modal footer -->
                    <div>
                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>

			</main>

@include('blog.include.footer')