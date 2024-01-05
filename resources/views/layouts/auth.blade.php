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
<body>
    <main class="main-content position-relative border-radius-lg ">
        @yield('content')
    </main>
    @stack('before_script')
    @include('includes.script')
    @stack('after_script')
</body>

</html>