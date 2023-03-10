<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change Password | IoT Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="center">
      <h1>Change Password</h1>
      <form action="{{ '/change-password' }}" method="post">
        @if (Session::has('failed'))
        <div class="alert alert-success">{{ Session::get('failed') }}</div>            
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>            
        @endif
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="txt_field">
          <input type="email" name="email" placeholder="Email" value="{{ $data->email }}">
          <span class="text-danger">@error('email') {{ $message }}@enderror</span>
        </div>
        <div class="txt_field">
          <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter Current Password">
          <span class="text-danger">@error('password') {{ $message }}@enderror</span>
        </div>
        <div class="txt_field">
          <input type="password" name="new_password" placeholder="Enter New Password">
          <span class="text-danger">@error('new_password') {{ $message }}@enderror</span>   
        </div>
        <div class="signup_link">
            <input type="submit" value="Change Password">
        </div>
      </form>
    </div>
  </body>
  </html>
  