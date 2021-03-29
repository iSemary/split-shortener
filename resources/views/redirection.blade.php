@extends('layouts.app')
@section('content')
    <title>Redirection...</title>
    <script>
        @if($url !== null)
        // you can add a delay and put ads if you want.
        let delayInMilliseconds = 5000; //5 second

        let timer = delayInMilliseconds, seconds;
        setInterval(function () {
            seconds = parseInt(timer % 9);
            seconds = seconds < 10 ? seconds : seconds;

            $("#RedirectionTime").html(seconds);
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);


        setTimeout(function () {
            // redirection after n second
            window.location.href = `{{$url}}`;

        }, delayInMilliseconds);
        @else
            window.location.href = `{{route('404')}}`;
        @endif
    </script>
    <div class="redirection-time">
        You will be redirected after <span id="RedirectionTime"></span>
    </div>
    <div class="adze-area">
        Ads area
    </div>
@endsection
