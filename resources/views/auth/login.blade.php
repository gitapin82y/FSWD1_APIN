@extends('layouts.auth')

@section('title','Login')

@push('after_style')

@endpush

@section('content')
<section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign In</h4>
                <p class="mb-0">Enter your email and password to sign in</p>
              </div>
              <div class="card-body">
                <form id="loginForm">
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control form-control-lg" required placeholder="Email" aria-label="Email">
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control form-control-lg" minlength="8" required placeholder="Password" aria-label="Password">
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Don't have an account?
                  <a href="/register" class="text-primary text-gradient font-weight-bold">Register</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
        background-size: cover;">
              <span class="mask bg-gradient-primary opacity-6"></span>
              <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
              <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('after_script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                event.preventDefault();
                axios.post('/api/login', new FormData(this))
                .then(response => {
                    localStorage.setItem('access_token', response.data.access_token);
                    // Handle successful login
                    console.log(response.data);
                    window.location.href = '/';
                })
                .catch(error => {
                    // Handle login error
                    console.error(error.response.data);
                });
            });
        });
    </script>
@endpush
