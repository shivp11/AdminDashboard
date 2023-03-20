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
                <form action="{{ '/like/'.$post_comment->id  }}" method="post">
                    @csrf
                   <button type="submit" class="btn btn-success btn-sm" ><i class="fa fa-thumbs-up"></i> {{ $likecount }}</button>
                </form>
                <form action="{{ '/dislike/'.$post_comment->id  }}" method="post">
                    @csrf
                   <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i> {{ $dislikecount }}</button>
                </form>
                </div>
             </div>
           </div>
        <hr>
        {{-- <br> --}}

    <!-- Blog Comments -->

    <!-- Comments Form -->
            @csrf
            {{-- {{ method_field('PUT') }} --}}
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>            
            @endif
            @if (Session::has('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
            @endif
      {{-- Comments Show --}}
      <ul style="list-style-type:none" class="mt-0 mb-0">
          <li style="list-style-type:none" class="mt-0 mb-0">
            @foreach ($comments as $comment)
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('images/' . $comment->comment_image) }}" class="rounded-circle mt-0" width="30" height="30"><br>
                </div>
                <div class="col">
                    <h1 class="fs-6 mb-0">{{ $comment->comment_author }}</h1>
                    <input type="hidden" id="comment_id" value="{{ $comment->comment_id }}">
                    <div class="col-auto fs-6">
                        <p class="fs-6 mb-0">{{ $comment->comment_content }}</p>
                        {{-- <a href="#" class="fs-6 me-2"><i class="fs-6 fa fa-thumbs-up me-1"></i>10</a> --}}
                        <a href="#" class="fs-6 me-2 reply" id="reply" onclick="display({{$comment->comment_id}});"><i class="fs-6 fa fa-mail-reply me-1"></i> Reply</a>
                    </div>
                </div>
              </div> <br>
          <ul style="list-style-type:none" class="mt-0 mb-0">
            <li style="list-style-type:none" class="mt-0 mb-0">
                @foreach ($replycomments as $replycomment)
                <div class="row align-items-center ">
                    <div class="col-auto">
                        <img src="{{ asset('images/' . $replycomment->reply_comment_image) }}" class="rounded-circle mt-0" width="30" height="30"><br>
                    </div>
                    <div class="col">
                        <h1 class="fs-6 mb-0">{{ $replycomment->reply_comment_author }}</h1>
                        <div class="col-auto fs-6">
                            <p class="fs-6 mb-0">{{ $replycomment->reply_comment_content }}</p>
                            {{-- <a href="#" class="fs-6 me-2"><i class="fs-6 fa fa-thumbs-up me-1"></i>10</a> --}}
                            <a  class="fs-6 me-2" onclick="recomment({{$replycomment->reply_comment_id}});"><i class="fs-6 fa fa-mail-reply me-1"></i> Reply</a>
                        </div>
                    </div>
                </div><br>
            </li>
            @endforeach
            <li style="list-style-type:none" class="mt-0 mb-0">
                @foreach ($rereplycomments as $rereplycomment)
                <div class="row align-items-center ">
                    <div class="col-auto">
                        <img src="{{ asset('images/' . $rereplycomment->rereply_comment_image) }}" class="rounded-circle mt-0" width="30" height="30"><br>
                    </div>
                    <div class="col">
                        <h1 class="fs-6 mb-0">{{ $rereplycomment->rereply_comment_author }}</h1>
                        <div class="col-auto fs-6">
                            <p class="fs-6 mb-0">{{ $rereplycomment->rereply_comment_content }}</p>
                            {{-- <a href="#" class="fs-6 me-2"><i class="fs-6 fa fa-thumbs-up me-1"></i>10</a> --}}
                            <a  class="fs-6 me-2" onclick="recomment({{$rereplycomment->rereply_comment_id}});"><i class="fs-6 fa fa-mail-reply me-1"></i> Reply</a>
                        </div>
                    </div>
                </div><br>
                @endforeach 
            </li>
          </ul>
        </li>

        <div class="modal" id="replyModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form-control" id="replyForm" action="" method="post" enctype="multipart/form-data"> 
                    @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title">Reply</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="input-group">
                            <img src="{{ asset('images/' . $data->profile) }}" class="rounded-circle me-1 mt-0" width="30" height="30">
                            <input type="hidden" name="post_id" value="{{ $post_comment->id }}">
                            <input type="hidden" name="comment_id" id="comment_id2">
                            <input  type="hidden" name="reply_comment_author" value="{{ $data->name }}">
                            <input  type="hidden" name="reply_comment_email" value="{{ $data->email }}">
                            <input  type="hidden" name="reply_comment_image" value="{{ $data->profile }}">
                            <input type="text" class="rounded form-control" name="reply_comment_content" placeholder="Enter Comment" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <button type="submit" class="btn btn-primary input-group-text" id="btnGroupAddon">Submit</button>
                    </div>
                </div>
              </form>
              </div>
            </div>
          </div>

        <div class="modal" id="replycomModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="form-control" id="replycomForm" action="" method="post" enctype="multipart/form-data"> 
                    @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title">Reply</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="input-group">
                            <img src="{{ asset('images/' . $data->profile) }}" class="rounded-circle me-1 mt-0" width="30" height="30">
                            <input type="hidden" name="comment_id" id="comment_id3">
                            <input  type="hidden" name="rereply_comment_author" value="{{ $data->name }}">
                            <input  type="hidden" name="rereply_comment_email" value="{{ $data->email }}">
                            <input  type="hidden" name="rereply_comment_image" value="{{ $data->profile }}">
                            <input type="text" class="rounded form-control" name="rereply_comment_content" placeholder="Enter Comment" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <button type="submit" class="btn btn-primary input-group-text" id="btnGroupAddon">Submit</button>
                    </div>
                </div>
              </form>
              </div>
            </div>
          </div>



        @endforeach  
      </ul>
      <div>
      <form action="/addcomment" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="input-group">
                <img src="{{ asset('images/' . $data->profile) }}" class="rounded-circle me-1 mt-0" width="30" height="30">
                <input type="hidden" name="comment_post_id" value="{{ $post_comment->id }}">
                {{-- <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}"> --}}
                <input type="hidden" name="user_id" value="{{ $data->id }}">
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
    $('#comment_id2').val(id);
    // console.log(id);

    $('#replyForm').attr('action', '/replycomment/'+id);
    $('#replyModal').modal('show');
    }

    function recomment(id) {
    $('#comment_id3').val(id);
    // console.log(id);

    $('#replycomForm').attr('action', '/rereplycomment/'+id);
    $('#replycomModal').modal('show');
    }
</script>

</main>
<script src="{{ asset('js/app.js') }}"></script>
@include('layouts.footer')