@extends('layouts.app')

@section('title') Podgląd sali @endsection
@section('additional_meta')
    <script type="text/javascript" src="{{ asset('js/map/jquery.seat-charts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map/seatchart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map/seatchart-preview.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/map/jquery.seat-charts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/map/seatchart-preview.css') }}">
@endsection

@section('content')
    <div class="front-indicator">
        <div>
            <a href="{{ route('user_classes') }}" class="checkout-button"> Zakończ podgląd </a>
        </div>
        <div class="classes-name-indicator">
            <p class="seat-p">
                {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->name }},
                {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->weekday }}
                {{ App\Classes::find($classes_id)->date }} {{ App\Subject::find(App\Classes::find($classes_id)->subject_id)->time }},
                <b>sala {{ App\Room::find(App\Subject::find(App\Classes::find($classes_id)->subject_id)->room_id)->name }}</b>
                @if(App\Classes::find($classes_id)->mode == 'test')
                    <span class="badge badge-warning" title="Zajęcia w trybie egzaminu"> Egzamin </span>
                @elseif(App\Classes::find($classes_id)->mode == 'quick')
                    <span class="badge badge-info" title="Zajęcia w trybie szybkim"> Tylko obecność </span>
                @endif
                <br> {{ App\Room::find(App\Subject::find(App\Classes::find($classes_id)->subject_id)->room_id)->description }}
            </p>
        </div>

    </div>
    <div class="preview-page-content">
        <div class="preview-attendance-table">
            <div class="card-header custom-header">
                <h4> Lista obecności <span class="badge badge-secondary" title="Liczba osób w sali"> {{ $attendances->count() }} </span></h4>
                @if($attendances->count() > 0)
                    <a href="{{ route('user_export', [$classes_id]) }}" class="btn btn-success btn-export" title="Wyeksportuj tabelę do xlsx"> <i class="fa fa-file-excel-o"></i> Wyeksportuj (.xlsx) </a>
                 @endif
            </div>
            @if ($errors->any())
                <div class="alert alert-danger invalid-feedback-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body card-custom">
                <span class="sort-span"> Sortuj: </span>
                <input type="hidden" id="orderBy-hidden" value="{{ $orderBy }}">
                <input type="hidden" id="orderDirection-hidden" value="{{ $orderDirection }}">
                <select id="sort-select" class="form-control form-custom" name="sort-select">
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'student_surname', 'orderDirection' => 'ASC']) }}">po nazwisku A-Z</option>
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'student_surname', 'orderDirection' => 'DESC']) }}">po nazwisku Z-A</option>
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'student_id_number', 'orderDirection' => 'ASC']) }}">po numerze indeksu rosnąco</option>
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'student_id_number', 'orderDirection' => 'DESC']) }}">po numerze indeksu malejąco</option>
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'seat_number', 'orderDirection' => 'ASC']) }}">po numerze miejsca rosnąco</option>
                    <option value="{{ route('user_preview_classes', ['classes_id' => $classes_id, 'orderBy' => 'seat_number', 'orderDirection' => 'DESC']) }}">po numerze miejsca malejąco</option>
                </select>
            </div>
            <div class="scrollable-div">
                <div class="table-responsive">
                    @include('user.attendances_table_preview', ['attendances' => $attendances, 'export' => 0])
                </div>
            </div>
        </div>
        <div class="seat-chart-wrapper">
            @if($multi_parts)
                <div id="map-carousel" class="carousel slide vertical" data-ride="carousel" data-interval="false" data-wrap="false">
                    <div class="carousel-inner scrollable" id="multi_parts-map">
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
                        <span class="sr-only">Pierwsza część</span>
                    </a>
                    <a class="carousel-control-next" href="#map-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Druga część</span>
                    </a>
                </div>
            @else
                <div id="seat-map"></div>
            @endif
        </div>
        <input type="hidden" class="room_arrangement" name="room_arrangement" id="room_arrangement" value="{{ $room_arrangement }}">
        <input type="hidden" class="multi_parts" name="multi_parts" id="multi_parts" value="{{ $multi_parts }}">
        @foreach($seat_numbers as $seat_number)
            <input type="hidden" class="unavailable_place" value="{{ $seat_number }}">
        @endforeach
    </div>

@endsection

