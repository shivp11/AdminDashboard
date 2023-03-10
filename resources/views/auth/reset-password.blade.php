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
      <h1>Reset Password</h1>
      <form action="/reset-password" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="txt_field">
          <input type="email" name="email" value="" placeholder="Email">
          <span class="text-danger">@error('email') {{ $message }}@enderror</span>
        </div>
        <div class="txt_field">
          <input type="password" name="password" value="" placeholder="Enter New Password">
          <span class="text-danger">@error('password') {{ $message }}@enderror</span>
        </div>
        <div class="txt_field">
          <input type="password" name="password_confirmation" value="" placeholder="Repeat Password">
          <span class="text-danger">@error('password_confirmation') {{ $message }}@enderror</span>
        </div>
        <div class="signup_link">
            <input type="submit" value="Reset Password">
        </div>
      </form>
    </div>
  </body>
  </html>
  