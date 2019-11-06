@if(isset($user))<!--proveruva dali postoj user -->


<p>Hi {{$user->name}}</p>
    @else
    <p>Hi there</p>
@endif
@yield('content')

<p>Thanks,File Market</p>