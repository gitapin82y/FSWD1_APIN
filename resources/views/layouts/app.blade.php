<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('title')
  </title>

    @stack('before_style')
    @include('includes.style')
    @stack('after_style')
    
</head>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('includes.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('includes.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
        
            @yield('content')

            @include('includes.footer')
        </div>
    </main>
    @stack('before_script')
    @include('includes.script')
    @stack('after_script')
</body>

</html>