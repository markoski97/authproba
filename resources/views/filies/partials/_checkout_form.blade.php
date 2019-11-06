<form action="{{route('checkout.payment',$file)}}" method="POST">

    {{csrf_field()}}

    ${{$file->price}}

    <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{$file->user->stripe_key}}"{{--OVA GO NAJDUVA NA KOJ USER PRIPAJCA FAJLO PREKU STRIPE KEY ZA NEGO DA MU SE PRATA PARITE--}}
            data-amount="{{$file->price * 100}}"{{--POSTO VO STIRPE SE RABOTI SO CENTOJ MORA SITE PRAJCOJ VO CENT DA SE PREFRLA i ova se pokazuva vo buttono--}}
            data-name="{{$file->title}}"{{--vlegova gore sho plajca usero za koj fajl--}}
            data-description="{{$file->overview_short}}"{{--pod naslov description short--}}
            data-locale="auto"
            data-currency="usd"
    >

    </script>


</form>