<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration | IoT Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="center">
      <h1>Registration</h1>
      <form action="registeruser" method="post" enctype="multipart/form-data">
        
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>            
        @endif
        @if (Session::has('failed'))
        <div class="alert alert-success">{{ Session::get('failed') }}</div>            
        @endif

        @csrf
          
          <div class="txt_field">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
            <span class="text-danger">@error('name') {{ $message }}@enderror</span>
            
          </div>
          <div class="txt_field">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            <span class="text-danger">@error('email') {{ $message }}@enderror</span>
          </div>
          <div class="d-none">
            {{-- <input type="text" id="role" name="role" value="role"> --}}
            <select class="d-none" name="role" id="role">
              <option value="Subscriber">Admin</option>  
              <option value="Subscriber">Subscriber</option>  
            </select>
            <span class="text-danger">@error('role') {{ $message }}@enderror</span>
          </div>
          <div class="txt_field">
            <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
            <span class="text-danger">@error('password') {{ $message }}@enderror</span>
            
            <div class="d-none">
                <input type="file" name="profile">
                <span class="text-danger">@error('profile') {{ $message }}@enderror</span>
            </div>
        </div>
        <input type="submit" value="SignUp">
        <div class="signup_link">
          Already Register!!!!<a href="login">Login Here</a>
        </div>
      </form>
    </div>
    
  </body>
  
  </html>
  


