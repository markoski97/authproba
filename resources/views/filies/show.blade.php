@extends('layouts.partials.plain')

@section('content')
    <section class="hero is-medium is-info">
        <div class="hero-body">
            <div class="container">
                @include('layouts.partials._flash'){{--Posle uspesen checkout_form_free daj mi message--}}
                <h3 class="subtitle is-spaced">
                    <storng>{{$file->user->name}}</storng>
                    is seling
                </h3>

                <h1 class="title is-1 is-spaed">{{$file->title}}</h1>
                <h2 class="subtitle">
                    {{$file->overview_short}}
                </h2>
                @if ($file->isFree())
                    @include('filies.partials._checkout_form_free'){{--AKO E FREEDAJ MU GO OVAJ VIE (SE MISLI NA BUTTONO I NA FORMATA ZA MAILO)--}}
                @else
                    @include(('filies.partials._checkout_form')){{--AKO TREBA DA SE PLATI FAJLO DAJ MU GO OVAJ VIEW--}}
                @endif


            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="content">
                <div class="columns">
                    <div class="column">
                        <h1 class="title">Overview</h1>
                        <p>{{$file->overview}}</p>


                    </div>


                    <div class="column">
                        <h1 class="title">What you get</h1>

                        @foreach($uploads as $upload)
                            <p>{{$upload->filename}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
