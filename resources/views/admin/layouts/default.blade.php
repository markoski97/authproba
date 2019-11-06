@extends ('layouts.app')

@section('content')
    @include('admin.layouts.partials.stats')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                    @include('admin.layouts.partials.navigation')
                </div>
                <div class="column">
                    @include('layouts.partials._flash')

                    @yield('admin.content')

                </div>
            </div>
        </div>
    </section>



@endsection