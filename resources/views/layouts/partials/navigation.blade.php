<nav class="nav">
    <div class="container">
        <div class="nav-left">
            <a href="{{route('home')}}" class="nav-item is-brand">
                {{config('app.name','Markter')}}
            </a>
        </div>
        <div class="nav-right nav-menu">

            @if(auth()->check())
                <a href="{{route('logout')}}" class="nav-item"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout').submit();">

                    Sign out
                </a>
                <a href="{{route('account')}}" class="nav-item">
                    Your account
                </a>
<!--pokazmudali mu admin panel ako e admin1 ako ne nepokazuvaj -->
           @if(auth()->user()->hasRole('admin1'))
                <a href="{{route('admin.index')}}" class="nav-item">
                    Admin
                </a>
                @endif
            @else


                <a href="{{route('login')}}" class="nav-item">

                    Sign in
                </a>
                <div class="nav-item">
                    <a href="{{route('register')}}" class="nav-item">
                        Start selling
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>

<form id="logout" action="{{route('logout')}}" method="POST" class="is-hidden">
    @csrf

</form>