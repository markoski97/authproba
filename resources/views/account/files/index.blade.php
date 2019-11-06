@extends ('account.layouts.default')

@section('account.content')
    <h1 class="title">YOUR FILES </h1>


    @if ($files->count())
        @each('account.partials._file',$files,'file')

    @else
        <p>You have no files</p>

    @endif
@endsection