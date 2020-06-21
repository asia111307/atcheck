@extends('layouts.app')

@section('title') Wybór miejsca @endsection
@section('additional_meta')
    <script type="text/javascript" src="{{ asset('js/map/jquery.seat-charts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map/seatchart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map/seatchart-custom.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/map/jquery.seat-charts.css') }}">

@endsection

@section('content')
    <div class="wrapper">
        <div class="seat-chart-wrapper">
            @if($multi_parts)
                <div class="front-indicator">
                    <div>
                        <a href="{{ route('user_classes') }}" class="checkout-button end-button"> Powrót do listy zajęć </a>
                    </div>
                    <div class="classes-name-indicator">
                        <p class="seat-p">
                            {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->name }},
                            {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->weekday }}
                            {{ App\Classes::find($classes_id)->date }} {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->time }},
                            <b>sala {{ App\Room::find(App\Subject::find(App\Classes::find($classes_id)->subject_id)->room_id)->name }}</b>
                            @if(App\Classes::find($classes_id)->mode == 'test')
                                <span class="badge badge-warning" title="Zajęcia w trybie egzaminu"> Egzamin </span>
                            @endif
                            <br> {{ App\Room::find(App\Subject::find(App\Classes::find($classes_id)->subject_id)->room_id)->description }}
                        </p>
                    </div>
                </div>
                <div id="map-carousel" class="carousel slide vertical" data-ride="carousel" data-interval="false" data-wrap="false">
                    <div class="carousel-inner" id="multi_parts-map">
                        <input type="hidden" id="multi_parts_number" value="{{ $parts_number }}">
                        @foreach(range(0, $parts_number-1) as $index)
                            @if($index == 0)
                                <div class="carousel-item active">
                                    <div id="seat-map-{{ $index }}"></div>
                                </div>
                            @else
                                <div class="carousel-item">
                                    <div id="seat-map-{{ $index }}"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#map-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span>Poprzednia część</span>
                    </a>
                    <a class="carousel-control-next" href="#map-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span>Następna część</span>
                    </a>
                </div>
            @else
                <div class="front-indicator">
                    <p class="seat-p">
                        {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->name }},
                        {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->weekday }}
                        {{ App\Classes::find($classes_id)->date }} {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->time }},
                        <b>sala {{ App\Room::find(App\Subject::find(App\Classes::find($classes_id)->subject_id)->room_id)->name }}</b>
                    </p>
                </div>
                <div id="seat-map"></div>
            @endif
        </div>
        <br/>
        <div class='seat-stat-wrapper'>
            <div id="legend">
            </div>
            <div class="booking-details">
                <h2 id="studentName"> <span class="student_name"> {{ $student_name }} </span><span class="student_surname"> {{ $student_surname }} </span> </h2>
                <h3 class="student_id_number"> {{ $student_id_number }}</h3>
                <h3>Twoje miejsce:
                    <span id="selected-seats"></span>
                </h3>
                @foreach($seat_numbers as $seat_number)
                    <input type="hidden" class="unavailable_place" value="{{ $seat_number }}">
                @endforeach
                <input type="hidden" class="room_arrangement" name="room_arrangement" id="room_arrangement" value="{{ $room_arrangement }}">
                @if($mode == 'test')
                    <input type="hidden" class="mode" name="mode" id="mode" value="{{ $mode }}">
                    <input type="hidden" class="random_seat" name="random_seat" id="random_seat" value="{{ $random_seat }}">
                @endif
                <form method="POST" action="{{ route('user_save_classes_data') }}">
                    <input type="hidden" value="{{ $classes_id }}" class="classes_id" name="classes_id">
                    <input type="hidden" value="{{ $student_name }}" class="student_name" name="student_name">
                    <input type="hidden" value="{{ $student_surname }}" class="student_surname" name="student_surname">
                    <input type="hidden" value="{{ $student_id_number }}" class="student_id_number" name="student_id_number">
                    <input type="hidden" value="" class="seat_number" name="seat_number">
                    @if($mode == 'test')
                        <button type="submit" class="checkout-button" id="test-end-btn">Zakończ &raquo;</button>
                    @else
                        <button type="submit" class="checkout-button">Zapisz &raquo;</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
