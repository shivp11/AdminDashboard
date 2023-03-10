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
      <form action="/forgot-password-email" method="post">
        @if (Session::has('status'))
        <div class="alert alert-success">{{ Session::get('status') }}</div>            
        @elseif (Session::has('email'))
        <div class="alert alert-danger">{{ Session::get('email') }}</div>            
        @endif
        @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif 
        @csrf
        <div class="txt_field">
          <input type="email" name="email" placeholder="Email" required>
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
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif      
                <form class="card card-md" action="/forgot-password-email" method="POST">
                    @csrf
                    <div class="card-body">
                      <p class="text-muted mb-4">Enter your email address and your password will be reset and emailed to you.</p>
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email" name='email'>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-footer">
                        <button  class="btn btn-primary w-100" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                          Send me reset password link
                        </button>
                      </div>
                    </div>
                  </form>
            </div>
          <div class="text-center text-muted mt-3">
            Forget it, <a href="login">send me back</a> to the sign in screen.
          </div>
        </div>
      </div>
    </div>


</body>
</html> --}}
