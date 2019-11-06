<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head')
</head>
<body>

@include ('layouts.partials.navigation')
@yield ('content')
@include('layouts.partials.scripts')
@yield('scripts')
</body>
</html>
