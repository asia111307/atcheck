@extends('layouts.adminpanel')

@section('title') Panel admina - Zajęcia @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5> Dodaj zajęcia </h5>
            <form method="POST" action="{{ route('admin_add_classes') }}">
                @csrf

                <div class="form-group row">
                    <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Przedmiot') }}</label>

                    <div class="col-md-6">
                        <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}, {{ $subject->weekday }} {{ $subject->time }}</option>
                            @endforeach
                        </select>

                        @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Data') }}</label>

                    <div class="col-md-6">
                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" autocomplete="date">

                        @error('date')
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
            @if ($classes->count() > 0)
                <h5> Wszystkie zajęcia: ({{ $classes->count() }}) </h5>
                <table class="table table-striped">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th> ID przedmoitu </th>
                        <th> Nazwa przedmiotu </th>
                        <th> Data </th>
                        <th> Kod </th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($classes as $classes_item)
                        <tr>
                            <td> {{ $classes_item->id }}</td>
                            <td> {{ $classes_item->subject_id }} </td>
                            <td> {{ App\Subject::find($classes_item->subject_id)->name }}, {{ App\Subject::find($classes_item->subject_id)->type }},
                                {{ App\Subject::find($classes_item->subject_id)->weekday }} {{ App\Subject::find($classes_item->subject_id)->time }}</td>
                            <td> {{ $classes_item->date }} </td>
                            <td> {{ $classes_item->classes_code }}</td>
                            <td>
                                <a href="{{ route('admin_delete_classes', [$classes_item->id]) }}" name="delete-classes-btn" class="btn btn-danger"> Usuń </a>
                            </td>
                            <td>
                                <a href="{{ route('admin_edit_classes', [$classes_item->id]) }}" name="edit-classes-btn" class="btn btn-secondary"> Edytuj </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p> Brak zajęć. </p>
            @endif
        </div>
    </div>
@endsection
