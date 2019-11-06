<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
<section class="hero is-primary is-large">
    <div class="hero-head">
        @include ('layouts.partials.navigation')
    </div>
    @yield ('content')
</section>
@include('layouts.partials.scripts')
</body>
</html>
