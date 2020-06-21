@extends('home')

@section('title') Mój Panel - Zajęcia @endsection

@section('user_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header custom-header">
                <h4> Sprawdź obecność </h4>
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
            <div class="card-body">
                <form method="POST" action="{{ route('user_add_classes') }}" class="classes-form">
                    @csrf
                    <div class="form-group row">
                        <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Przedmiot') }}</label>

                        <div class="col-md-6">
                            <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}, {{ $subject->weekday }} {{ $subject->time }}, sala {{ App\Room::find($subject->room_id)->name }}</option>
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
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $defaultDate }}" required autocomplete="date">

                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="mode-div">
                            <div>
                                <label for="test-mode" class="form-check-label">{{ __('Tryb egzaminu') }}</label>
                                <input id="test-mode" type="checkbox" class="form-control @error('mode') is-invalid @enderror" name="mode" value="test">
                            </div>
                            <div>
                                <label for="quick-mode" class=" form-check-label">{{ __('Tryb szybki') }}</label>
                                <input id="quick-mode" type="checkbox" class="form-control @error('mode') is-invalid @enderror" name="mode" value="quick">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" title="Dodaj zajęcia i rozpocznij zapisy">
                                {{ __('Dodaj zajęcia i rozpocznij zapisy') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if ($classes->count() > 0)
                <div class="card-header custom-header">
                    <h4> Moje zajęcia <span class="badge badge-secondary" title="Liczba zajęć"> {{ $classes->count() }} </span> </h4>
                </div>

                <div class="card-body card-custom">
                    <span class="sort-span"> Grupuj: </span>
                    <input type="hidden" id="groupBy-hidden" value="{{ $grouped_by }}">
                    <select id="group-select" class="form-control form-custom" name="group-select">
                        <option value="{{ route('user_classes', ['subject_id']) }}"> po nazwie przedmiotu </option>
                        <option value="{{ route('user_classes', ['date']) }}"> po dacie </option>
                    </select>
                </div>

                <div class="card-body">
                    @foreach ($classes_grouped as $classes_group_name => $classes_list)
                        @if($classes_group_name)
                            @if($grouped_by == 'subject_id')
                                <h5 class="card-title"> {{ App\Subject::find($classes_group_name)->name }},
                                    {{ App\Subject::find($classes_group_name)->weekday }} {{ App\Subject::find($classes_group_name)->time }} <span class="badge badge-secondary" title="Liczba zajęć"> {{ $classes_list->count() }} </span> </h5>
                            @else
                                <h5 class="card-title"> {{ $classes_group_name }} <span class="badge badge-secondary" title="Liczba zajęć"> {{ $classes_list->count() }} </span> </h5>
                            @endif
                        @else
                            <h5 class="card-title"> Inne <span class="badge badge-secondary" title="Liczba zajęć"> {{ $classes_list->count() }} </span></h5>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless custom-table">
                                <tr class="thead-dark">
                                    <th> Nazwa przedmiotu </th>
                                    <th> Data </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($classes_list as $classes_item)
                                    <tr>
                                        <td> {{ App\Subject::find($classes_item->subject_id)->name }},
                                            {{ App\Subject::find($classes_item->subject_id)->weekday }} {{ App\Subject::find($classes_item->subject_id)->time }}, sala {{ App\Room::find(App\Subject::find($classes_item->subject_id)->room_id)->name }}
                                            @if($classes_item->mode == 'test')
                                                <span class="badge badge-warning" title="Zajęcia w trybie egzaminu"> Egzamin </span>
                                            @elseif($classes_item->mode == 'quick')
                                                <span class="badge badge-info" title="Zajęcia w trybie szybkim"> Tylko obecność </span>
                                            @endif
                                        </td>
                                        <td> {{ $classes_item->date }} </td>
                                        <td>
                                            @if($classes_item->classes_code)
                                                <a href="{{ route('user_start_classes', [$classes_item->id]) }}" name="start-classes-btn" class="btn btn-secondary" title="Kontynuuj zapisy"> <i class="fa fa-play"></i> Kontynuuj zapisy  </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user_preview_classes', [$classes_item->id]) }}" name="preview-classes-btn" class="btn btn-primary" title="Zobacz podgląd sali"> <i class="fa fa-television"></i> Zobacz salę  </a>
                                        </td>
                                        <td>
                                            <button type="button" name="delete-classes-btn" class="btn btn-danger" data-toggle="modal" data-target="#classesConfirmationModal-{{ $classes_item->id }}" title="Usuń zajęcia">  <i class="fa fa-trash-o"></i> Usuń </button>
                                        </td>
                                    </tr>
                                    @include('user.delete_confirmation_classes', [$classes_item])
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="card-body">
                        <p> Brak zajęć. </p>
                    </div>
                @endif
            </div>
        </div>
@endsection
