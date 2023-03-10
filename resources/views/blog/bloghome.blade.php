@include('layouts.header')

<main class="content">
    <div class="container-fluid p-0">


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
<script src="js/app.js"></script>
@include('layouts.footer')