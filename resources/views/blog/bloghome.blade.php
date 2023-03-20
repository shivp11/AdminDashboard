@include('layouts.header')

<main class="content">
    <div class="container-fluid">
      @if (Session::has('success'))
      <div class="alert alert-success">{{ Session::get('success') }}</div>            
      @endif
      @if (Session::has('failed'))
      <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
      @endif
        @foreach ($posts as $post)
        <!-- Blog Post -->
        <h2>
            <a href="{{ 'comment/'. $post->id }}">{{ $post->post_title }}</a>
        </h2>
        <p class="lead">
            by <a href="{{ 'blog' }}">{{ $post->post_author }}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->post_date }}</p>
        <hr>
        <img class="img-responsive" src="{{ asset('images/post/'.$post->post_image) }}" alt="">
        <hr>
        <p> <b>Content:- </b> {{ $post->post_content }}</p>
        <hr>
        <br>
        @endforeach

</div>
</main>

<script>$(document).ready(function () {
    $('#postData').DataTable({
      retrieve: true,
      order: [[5, 'desc']],
      "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
      "pageLength": 5
    });
  });</script>
<script src="js/app.js"></script>
@include('layouts.footer')