<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend._head')
</head>
<body class="app sidebar-mini">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="#">{{ config('app.name') }}</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    @include('layouts.backend._header')
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    @include('layouts.backend._aside')
</aside>
<main class="app-content">
    @yield('content')
</main>
<!-- Essential javascripts for application to work-->



<!-- scripts for toastr to trigger-->
<script>
    @if(session('success'))
    toastr.success("{{ session('success') }}")
    @endif

    @if(session('error'))
    toastr.error("{{ session('error') }}")
    @endif

    @if(session('warning'))
    toastr.warning("{{ session('warning') }}")
    @endif
</script>

@include('layouts.backend._scripts')
</body>
</html>
