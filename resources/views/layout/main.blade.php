<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP-SRePS</title>

    @include('utilities/stylesheets')
</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark bg-green">
    <a href="/" class="navbar-brand">PHP-SRePS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="/products" class="nav-link">Products</a>
            </li>
            <li class="nav-item">
                <a href="/sales" class="nav-link">Sales</a>
            </li>
            <li class="nav-item">
                <a href="/reports" class="nav-link">Reports</a>
            </li>
        </ul>
    </div>
</header>
<div class="container">
    @yield('content')
</div>
@include('utilities/bootstrap-js')

{{--
    So we can include script tags for different views.
--}}
@stack('javascript')
</body>
</html>
