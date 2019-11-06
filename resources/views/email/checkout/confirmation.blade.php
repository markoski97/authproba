@extends('email.layauts.default')   {{--layout za site mailoj isti da bida--}}



@section('content')
    <p>Thanks for downloading
        <strong>{{$sale->file->title}}</strong>
        From FileMarket </p>

    <p><a href="{{route('files.download',[$sale->file,$sale])}}">Download your file</a></p>


    <p>
        Or,Copy and Paste this int your browser <br>
        {{route('files.download',[$sale->file,$sale])}}

    </p>
@endsection