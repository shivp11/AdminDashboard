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
      <h1>Login</h1>
      <form action="loginuser" method="post">
        @if (Session::has('changed'))
        <div class="alert alert-success">{{ Session::get('changed') }}</div> 
        @endif 
        @if (Session::has('status'))
        <div class="alert alert-success">{{ Session::get('status') }}</div> 
        @endif 
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>            
        @endif
        @if (Session::has('failed'))
        <div class="alert alert-danger">{{ Session::get('failed') }}</div>            
        @endif

        @csrf
        <div class="txt_field">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
          <span class="text-danger">@error('email') {{ $message }}@enderror</span>
        </div>
        <div class="txt_field">
          <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
          <span class="text-danger">@error('password') {{ $message }}@enderror</span>
        </div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member!!! <a href="registration">Signup</a>
          <br><a href="forgot">Forgot Password!!!</a>
        </div>
        {{-- <div class="signup_link">
        </div> --}}
      </form>
    </div>
  </body>
  </html>
  