<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | IoT Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="center">
      <h1>Trouble logging in?</h1>
      <p style="text-align: center">Enter your email and we'll send you a link to get back into your account.</p>
      <form action="/forgot-password" method="post">
        @if (Session::has('status'))
        <div class="alert alert-success">{{ Session::get('status') }}</div>            
        @elseif (Session::has('email'))
        <div class="alert alert-danger">{{ Session::get('email') }}</div>            
        @endif
        @csrf
        <div class="txt_field">
          <input type="email" name="email" placeholder="Email">
          <span class="text-danger">@error('email') {{ $message }}@enderror</span>
          
        </div>
        <div class="signup_link">
            <input type="submit" value="Send Reset link">
          </div>
          <div class="signup_link">
            If you remember password!!! <a href="login">Log In</a>
          </div>
      </form>
    </div>
  </body>
  </html>
  