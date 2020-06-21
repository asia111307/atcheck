@extends('layouts.app')

@section('title') Wybór miejsca @endsection
@section('additional_meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/map/jquery.seat-charts.css') }}">
@endsection

@section('content')
    <div class="wrapper">
        <div class="map-buttons">
            <a href="{{ route('user_classes') }}" class="checkout-button end-button"> Zakończ zapisy </a>
            <button type="button" class="checkout-button end-button add-mn-btn"> Dodaj studenta ręcznie</button>
        </div>
        <div id="refresh"></div>
        <div class="classes-code-div code-p" id="classes-code-div">
            <p class="m-0" id="classes-code"><b>Kod weryfikacyjny:</b></p>
            <input type="text" id="classes_code_input" value="{{ $classes_code }}">
            <button type="button" id="copy-btn" class="btn btn-primary" title="Kopiuj do schowka"><i class="fa fa-clone"></i> Kopiuj <span id="copy-counter">(30) &raquo;</span> </button>
        </div>
        <div class="code-p"> Stan połączenia z serwerem legitymacji: <span id="status" style="color:green"> połączony</span></div>

        <h1 class="main-text main-seat-text">Przyłóż legitymację do czytnika</h1>
        @if ($errors->any())
            <div class="alert alert-danger invalid-feedback-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-reader">
            <form method="POST" action="{{ route('user_start_classes_verified') }}" class="card-reader-form">
                <div>
                    <input type="hidden" name="classes_code" id="classes_code" value="{{ $classes_code }}" required>
                </div>
                <div>
                    <label for="student_id_number"> Nr indeksu: </label>
                    <input type="number" name="student_id_number" id="student_id_number" required>
                </div>
                <div>
                    <label for="student_name"> Imię: </label>
                    <input type="text" name="student_name" id="student_name" required>
                </div>
                <div>
                    <label for="student_surname"> Nazwisko: </label>
                    <input type="text" name="student_surname" id="student_surname" required>
                </div>
                <button type="submit" id="submit" class="checkout-button"> Dodaj studenta </button>
            </form>
        </div>

        <script>
            var classes_code_input = $('#classes_code_input').val();
            const client = new WebSocket('wss://atcheck.projektstudencki.pl/wss', classes_code_input);

            client.onclose = function(event) {
                $('#status').text(" rozłączony");
                $('#status').css("color", "red");
            };

            client.onmessage = function onmessage1(message) {
                message = JSON.parse(message.data);
                if (message.type = "data") {
                    $('#student_id_number').val(message['id']);
                    $('#student_name').val(message['name']);
                    $('#student_surname').val(message['surname']);
                    $('#classes_code').val(message['classes_code']);
                    $('#submit').click();
                }
            }

            var counter = 30;
            setInterval(function() {
                counter--;
                $('#copy-counter').html('(' + counter + ') &raquo;');
            }, 1000);

        </script>
    </div>
@endsection
