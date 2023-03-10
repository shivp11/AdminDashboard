@include('layouts.header')
<main class="content">
    <div class="container-fluid p-0">
       
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
        <p> <b>Content:- </b> {{ $post_comment->post_content }}</p>
        <hr>
        <br>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="/addcomment" method="POST" enctype="multipart/form-data" >
            @csrf
            {{-- {{ method_field('PUT') }} --}}
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>            
            @endif
            @if (Session::has('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
            @endif
            <input type="hidden" name="comment_post_id" value="{{ $post_comment->id }}">
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
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <?php
    use App\Models\comment;
    ?>

    <!-- Comment -->
    <div class="media">
         @foreach ($comments as $comment)
         <a class="pull-left" href="#">
            <img class="img-fluid rounded mb-2" width="40" height="40" src="{{ asset('images/comments/' . $comment->comment_image) }}">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->comment_author }}
                <small>{{ $comment->comment_date }}</small>
            </h4>
            {{ $comment->comment_content }}
        </div>
           @endforeach
    </div>
</div>
</main>
<script src="{{ asset('js/app.js') }}"></script>
@include('layouts.footer')