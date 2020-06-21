@extends('layouts.adminpanel')

@section('title') Panel admina - obecności @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5> Dodaj obecność </h5>
            <form method="POST" action="{{ route('admin_add_attendance') }}" class="col-md-12">
                @csrf

                <div class="form-group row">
                    <label for="classes_id" class="col-md-4 col-form-label text-md-right">{{ __('Zajęcia') }}</label>

                    <div class="col-md-6">
                        <select id="classes_id" class="form-control @error('classes_id') is-invalid @enderror" name="classes_id" required>
                            @foreach ($classes as $classes_item)
                                <option value="{{ $classes_item->id }}">{{ App\Subject::find(App\Classes::find($classes_item->id)->subject_id)->name }},
                                    {{ App\Classes::find($classes_item->id)-> date }} {{ App\Subject::find(App\Classes::find($classes_item->id)->subject_id)->time }}
                                </option>
                            @endforeach
                        </select>

                        @error('classes_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('ID studenta') }}</label>

                    <div class="col-md-6">
                        <input id="student_id" type="number" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                        @error('student_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="student_name" class="col-md-4 col-form-label text-md-right">{{ __('Imię studenta') }}</label>

                    <div class="col-md-6">
                        <input id="student_name" type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" value="{{ old('student_name') }}" autocomplete="student_name">

                        @error('student_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="student_surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko studenta') }}</label>

                    <div class="col-md-6">
                        <input id="student_surname" type="text" class="form-control @error('student_surname') is-invalid @enderror" name="student_surname" value="{{ old('student_surname') }}" autocomplete="student_surname">

                        @error('student_surname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="seat_number" class="col-md-4 col-form-label text-md-right">{{ __('Nr miejsca') }}</label>

                    <div class="col-md-6">
                        <input id="seat_number" type="number" class="form-control @error('seat_number') is-invalid @enderror" name="seat_number" value="{{ old('seat_number') }}" required autocomplete="seat_number" autofocus>

                        @error('seat_number')
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

            @if ($attendances->count() > 0)
                <h5> All attendance records: ({{ $attendances->count() }}) </h5>
                <table class="table table-striped">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th> ID zajęc </th>
                        <th> Nazwa zajęć </th>
                        <th> ID studenta </th>
                        <th> Imię studenta</th>
                        <th> Nazwisko studenta </th>
                        <th> Nr miejsca </th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td> {{ $attendance->id }}</td>
                            <td> {{ $attendance->classes_id }} </td>
                            <td> {{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->name }},
                                {{ App\Classes::find($attendance->classes_id)-> date }} {{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->time }} </td>
                            <td> {{ $attendance->student_id_number }} </td>
                            <td> {{ $attendance->student_name}}</td>
                            <td> {{ $attendance->student_surname}}</td>
                            <td> {{ $attendance->seat_number }} </td>
                            <td>
                                <a href="{{ route('admin_delete_attendance', [$attendance->id]) }}" name="delete-attendance-btn" class="btn btn-danger"> Usuń </a>
                            </td>
                            <td>
                                <a href="{{ route('admin_edit_attendance', [$attendance->id]) }}" name="edit-attendance-btn" class="btn btn-secondary"> Edytuj </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p> Brak obecności. </p>
            @endif
        </div>
    </div>
@endsection
