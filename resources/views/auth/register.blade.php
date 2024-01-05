@extends('layouts.auth')

@section('title','Register')

@push('after_style')

@endpush

@section('content')
<section>
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Welcome!</h1>
          <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-body">
            <form id="registerForm">
              <div class="mb-3">
                <input type="text"  name="name" class="form-control" required placeholder="Name" aria-label="Name">
              </div>
              <div class="mb-3">
                <input type="email"  name="email" class="form-control" required placeholder="Email" aria-label="Email">
              </div>
              <div class="mb-3">
                <input type="password"  name="password" class="form-control" minlength="8" required placeholder="Password" aria-label="Password">
              </div>
              <div class="form-check form-check-info text-start">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                <label class="form-check-label" for="flexCheckDefault">
                  I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                </label>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Register</button>
              </div>
              <p class="text-sm mt-3 mb-0">Already have an account? <a href="/login" class="text-dark font-weight-bolder">Login</a></p>
            </form>
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
            $('#registerForm').submit(function (event) {
                event.preventDefault();
                axios.post('/api/register', new FormData(this))
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
