@extends('layouts.app')

@section('title') Wybór miejsca @endsection
@section('additional_meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/map/jquery.seat-charts.css') }}">
@endsection

@section('content')
    <div class="wrapper">
        <div class="map-buttons">
            <a href="{{ route('user_classes') }}" class="checkout-button end-button"> Zakończ zapisy </a>
        </div>
        @if($warning)
            <h1 class="summary-map-h"> {{ $warning }} </h1>
        @else
            <h1 class="summary-map-h"> Zostałeś poprawnie zapisany.</h1>
        @endif
        <br><br>
        <h2> {{ $student_name }} {{ $student_surname }} </h2>
        <br><br>

        <h3> {{ $student_id_number }} </h3>
        <br><br>
        @if(!$mode == "quick")
            <h3> miejsce: </h3>
            <ul id="sel-seat"> {{ $seat_number }} </ul>
        @endif
        <a href="{{ route('user_start_classes', [$classes_id]) }}"><button type="button" id="next_student" class="checkout-button">Następny student (2) &raquo;</button></a>
    </div>

    <script>
        var counter = 1;

        var t = setInterval(function() {
            $('#next_student').html('Następny student (' + counter + ') &raquo;');
            counter--;
        }, 1000);

        window.setTimeout(function(){
            clearInterval(t);
            $('#next_student').click();
        }, 3000);

    </script>
@endsection
