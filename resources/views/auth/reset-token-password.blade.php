
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
      <form action="/repwd" method="post">
        @csrf
        @if (Session::has('fail'))
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>            
        @endif
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
  










{{-- <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | IoT Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>

    <div class="center">
        <div class="page page-center">
            <div class="container-tight py-4">
            <h2 class="card-title text-center mb-4">Forgot password</h2>
            <div class="text-center mb-4">
            </div>
            
            <div>

              @if(Session::get('fail'))
                  <div class="alert alert-danger">
                      {!! Session::get('fail') !!}
                  </div>
              @endif
          
              @if(Session::get('success'))
                  <div class="alert alert-success">
                      {!! Session::get('success') !!}
                  </div>
              @endif
              
              <form class="card card-md"  action="/repwd" method="post" autocomplete="off">
                @csrf
                  <div class="card-body">
                    <h2 class="card-title text-center mb-4">Reset password</h2>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="text" class="form-control" placeholder="Enter email address" name="email">
                      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        New Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="New Password" autocomplete="off" name="new_password">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                          </a>
                        </span>
                       
                      </div>
                      <span class="text-danger">@error('new_password'){{ $message }}@enderror</span>
                    
                    </div>
          
                    <div class="mb-2">
                      <label class="form-label">
                        Confirm Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="Confirm Password" autocomplete="off" name="confirm_new_password">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                          </a>
                        </span>
                       
                      </div>
                      <span class="text-danger">@error('confirm_new_password'){{ $message }}@enderror</span>
                    
                    </div>
          
                    <div class="mb-2">
                      <label class="form-check">
                        <a href="login">Back to Login page</a>
                      </label>
                    </div>
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </div>


</body>
</html> --}}
