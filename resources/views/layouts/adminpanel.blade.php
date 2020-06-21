@extends('layouts.app')

@section('title') Panel admina @endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (!Auth::user()->is_Admin)
                <p> Nie możesz przejść na tę stronę. </p>
                <a href="{{ route('home') }}"> Powrót na Stronę Główną </a>
            @else
                <div class="card">
                    <div class="card-header">Panel admina</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin_users') }}" class="btn btn-primary"> Prowadzący </a>
                        <a href="{{ route('admin_subjects') }}" class="btn btn-primary"> Przedmioty </a>
                        <a href="{{ route('admin_rooms') }}" class="btn btn-primary"> Sale </a>
                        <a href="{{ route('admin_classes') }}" class="btn btn-primary"> Zajęcia </a>
                        <a href="{{ route('admin_attendances') }}" class="btn btn-primary"> Obecności </a>
                        <a href="{{ route('admin_test_connection') }}" class="btn btn-primary"> Test requesta </a>
                    </div>
                    <div class="card-body">
                        @yield('admin_content')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
