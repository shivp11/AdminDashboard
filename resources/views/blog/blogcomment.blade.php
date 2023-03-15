@include('layouts.header')
<main class="content">
    <div class="container">
       
        <!-- Blog Post -->
        <h2>
            <a href="{{ '/comment/'. $post_comment->id }}">{{ $post_comment->post_title }}</a>
        </h2>
        <p class="lead">
            by <a href="{{ 'blog' }}">{{ $post_comment->post_author }}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post_comment->post_date }}</p>
        <hr>
        <img class="img-responsive" src="{{ asset('images/post/'.$post_comment->post_image) }}" alt="">
        <hr>
         <b>Content</b> <p>{{ $post_comment->post_content }}</p>
         <hr>
         <div class="row align-items-center">
             <div class="col-auto">
               <div class="reaction">
                   <a href="/like" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i> 13</a>
                   <a href="/dislike" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i> 0</a>
               </div>
             </div>
           </div>
        <hr>
        {{-- <br> --}}

    <!-- Blog Comments -->

    <!-- Comments Form -->
    {{-- <div class="well"> --}}
        {{-- <h4>Leave a Comment:</h4> --}}
            @csrf
            {{-- {{ method_field('PUT') }} --}}
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>            
            @endif
            @if (Session::has('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
            @endif
            {{-- <input type="hidden" name="comment_post_id" value="{{ $post_comment->id }}">
            <div  class="form-group">
                <input class="form-control" type="text" name="comment_author" placeholder="Name">
                <span class="text-danger">@error('comment_author') {{ $message }}@enderror</span>
            </div><br>
            <div  class="form-group">
                <input class="form-control" type="email" name="comment_email" placeholder="Email">
                <span class="text-danger">@error('comment_email') {{ $message }}@enderror</span>
            </div><br>
            <div  class="form-group">
                <input class="form-control" type="file" name="comment_image">
                <span class="text-danger">@error('comment_image') {{ $message }}@enderror</span>
            </div><br>
            <div class="form-group">
                <label for="">Comment</label>
                <textarea class="form-control" name="comment_content" rows="3"></textarea>
                <span class="text-danger">@error('comment_content') {{ $message }}@enderror</span>
            </div><br>

            <button type="submit" class="btn btn-primary">Submit</button>
    </div> --}}

    {{-- <hr> --}}

    <!-- Posted Comments -->
    <!-- Comment -->
    <div class="media">
         @foreach ($comments as $comment)
         <a class="pull-left" href="#">
            <img class="img-fluid rounded mb-2" width="40" height="40" src="{{ asset('images/comments/' . $comment->comment_image) }}">
        </a>
        <div class="media-body">
            {{-- <input type="hidden" class="comment_id" value="{{ $comment->comment_id }}"> --}}
            <h4 class="media-heading">{{ $comment->comment_author }}
                <small>{{ $comment->comment_date }}</small>
            </h4>
            {{ $comment->comment_content }}
            <br>
            <a href="#" class="me-2"><i class="fa fa-thumbs-up me-1"></i>10</a>
            <a class="reply" id="reply" name="reply" onclick="display({{$comment->comment_id}});">Reply</a>
        </div>
           @endforeach
    </div>
    
      {{-- Comments Show --}}
      {{-- <ul style="list-style-type:none">
          <li style="list-style-type:none" >
            @foreach ($comments as $comment)
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('images/' . $comment->comment_image) }}" class="rounded-circle mt-0" width="50" height="50"><br>
                </div>
                <div class="col">
                    <h1 class="fs-4 mb-0">{{ $comment->comment_author }}</h1>
                    <input type="hidden" id="comment_id" value="{{ $comment->comment_id }}">
                    <div class="col-auto">
                        <p class="mb-0">{{ $comment->comment_content }}</p>
                        <a href="#" class="me-2"><i class="fa fa-thumbs-up me-1"></i>10</a>
                        <a href="#" class="me-2 reply" id="reply" >Reply</a>
                    </div>
                </div>
              </div> <br>
          <ul style="list-style-type:none">
            <li style="list-style-type:none">
                @foreach ($comments as $comment)
                <div class="row align-items-center ">
                    <div class="col-auto">
                        <img src="{{ asset('images/' . $comment->comment_image) }}" class="rounded-circle mt-0" width="50" height="50"><br>
                    </div>
                    <div class="col">
                        <h1 class="fs-4 mb-0">{{ $comment->comment_author }}</h1>
                        <div class="col-auto">
                            <p class="mb-0">{{ $comment->comment_content }}</p>
                            <a href="#" class="me-2"><i class="fa fa-thumbs-up me-1"></i>10</a>
                            <a href="#" class="me-2">Reply</a>
                        </div>
                    </div>
                </div><br>
                @endforeach 
            </li>
          </ul>
        </li> --}}

        {{-- <div class="modal" id="replyModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form-control" id="replyForm" action="" method="post" enctype="multipart/form-data"> 
                    @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title">Reply</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> --}}
                <!-- Modal body -->
                {{-- <div class="modal-body">
                    <input type="hidden" name="comment_id">
                    <input type="hidden" name="post_id" value="{{ $post_comment->id }}">
                    <div><input class="form-control" type="text" name="reply_comment_author" placeholder="Name" required>
                        <span class="text-danger">@error('reply_comment_author') {{ $message }}@enderror</span>
                      </div><br>
                      <div><input class="form-control" type="email" name="reply_comment_email" placeholder="Email" required>
                        <span class="text-danger">@error('reply_comment_email') {{ $message }}@enderror</span>
                      </div><br>
                      <div><input class="form-control" type="text" name="reply_comment_image"  placeholder="Role" required>
                        <span class="text-danger">@error('reply_comment_image') {{ $message }}@enderror</span>
                      </div><br>
                </div> --}}
          
                <!-- Modal footer -->
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Delete</button>
                </div>
              </form>
              </div>
            </div>
          </div> --}}



        {{-- @endforeach   --}}
      </ul>
      <div>
      <form action="/addcomment" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="input-group">
                <img src="{{ asset('images/' . $data->profile) }}" class="rounded-circle me-1 mt-0" width="30" height="30">
                <input type="hidden" name="comment_post_id" value="{{ $post_comment->id }}">
                {{-- <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}"> --}}
                <input  type="hidden" name="comment_author" value="{{ $data->name }}">
                <input  type="hidden" name="comment_email" value="{{ $data->email }}">
                <input  type="hidden" name="comment_image" value="{{ $data->profile }}">
                <input type="text" class="rounded form-control" name="comment_content" placeholder="Enter Comment" aria-label="Input group example" aria-describedby="btnGroupAddon">
                <button class="btn btn-primary input-group-text" id="btnGroupAddon">Submit</button>
            </div>
        </div>
    </form>
</div>



<script type="text/javascript">

// $('.reply').click(function() {
//     var id = $('.comment_id').val();
//     alert(id)
//     console.log(id);
// });

    function display(id) {
        alert(id);
        console.log(id);
    }
</script>

</main>
<script src="{{ asset('js/app.js') }}"></script>
@include('layouts.footer')