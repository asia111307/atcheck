@extends('layouts.adminpanel')

@section('title') Panel admina - Przedmioty @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5> Dodaj przedmiot </h5>
            <form method="POST" action="{{ route('admin_add_subject') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{--<div class="form-group row">--}}
                    {{--<label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>--}}

                    {{--<div class="col-md-6">--}}
                        {{--<select id="type" class="form-control @error('type') is-invalid @enderror" name="type">--}}
                            {{--<option label="-- select type -- "></option>--}}
                            {{--@foreach ($types as $type)--}}
                                {{--<option value="{{ $type }}">{{ $type }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}

                        {{--@error('type')--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $message }}</strong>--}}
                        {{--</span>--}}
                        {{--@enderror--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group row">
                    <label for="weekday" class="col-md-4 col-form-label text-md-right">{{ __('Dzień tygodnia') }}</label>

                    <div class="col-md-6">

                        <select id="weekday" class="form-control @error('weekday') is-invalid @enderror" name="weekday">
                            <option label="-- select day of the week -- "></option>
                            @foreach ($weekdays as $weekday)
                                    <option value="{{ $weekday }}">{{ $weekday }}</option>
                            @endforeach
                        </select>

                        @error('weekday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Godzina') }}</label>

                    <div class="col-md-6">
                        <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" autocomplete="time">

                        @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{--<div class="form-group row">--}}
                    {{--<label for="room_id" class="col-md-4 col-form-label text-md-right">{{ __('Room') }}</label>--}}

                    {{--<div class="col-md-6">--}}
                        {{--<select id="room_id" class="form-control @error('room_id') is-invalid @enderror" name="room_id" required>--}}
                            {{--@foreach ($rooms as $room)--}}
                                {{--<option value="{{ $room->id }}">{{ $room->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}

                        {{--@error('room_id')--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $message }}</strong>--}}
                        {{--</span>--}}
                        {{--@enderror--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group row">
                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Prowadzący') }}</label>

                    <div class="col-md-6">
                        <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>

                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Dodaj') }}
                        </button>
                    </div>
                </div>
            </form>
            @if ($subjects->count() > 0)
                <h5> Wszystkie przedmioty: ({{ $subjects->count() }}) </h5>
                <table class="table table-striped">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th> Nazwa </th>
                        {{--<th> Type </th>--}}
                        <th> Dzień tygodnia </th>
                        <th> Godzina </th>
                        <th> ID prowadzącego </th>
                        <th> Prowadzący </th>
                        {{--<th> Room id </th>--}}
                        {{--<th> Room name </th>--}}
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td> {{ $subject->id }}</td>
                            <td> {{ $subject->name }} </td>
                            {{--<td> {{ $subject->type }} </td>--}}
                            <td> {{ $subject->weekday }} </td>
                            <td> {{ $subject->time }} </td>
                            <td> {{ $subject->user_id}}</td>
                            <td> {{ App\User::find($subject->user_id)->name }} {{ App\User::find($subject->user_id)->surname }}</td>
                            {{--<td> {{ $subject->room_id}}</td>--}}
                            {{--<td> {{ App\Room::find($subject->room_id)->name }} </td>--}}
                            <td>
                                <a href="{{ route('admin_delete_subject', [$subject->id]) }}" name="delete-subject-btn" class="btn btn-danger"> Usuń </a>
                            </td>
                            <td>
                                <a href="{{ route('admin_edit_subject', [$subject->id]) }}" name="edit-subject-btn" class="btn btn-secondary"> Edytuj </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p> Brak przedmiotów. </p>
            @endif
        </div>
    </div>
@endsection
