@extends('home')

@section('title') Mój Panel - Przedmioty @endsection

@section('user_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header custom-header">
                <h4> Moje przedmioty <span class="badge badge-secondary" title="Liczba przedmiotów"> {{ $subjects->count() }} </span></h4>
                <button type="button" class="btn btn-primary add-subject-btn" title="Dodaj nowy przedmiot"> <i class="fa fa-plus"></i> Dodaj nowy przedmiot </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger invalid-feedback-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="subject_id_redirected" value="{{ Illuminate\Support\Facades\Session::get('subject_id_redirected') }}">
            @endif
            <div class="card-body add-subject">
                <h5> Dodaj nowy przedmiot </h5>
                <form method="POST" action="{{ route('user_add_subject') }}">
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

                    <div class="form-group row">
                        <label for="weekday" class="col-md-4 col-form-label text-md-right">{{ __('Dzień tygodnia') }}</label>

                        <div class="col-md-6">

                            <select id="weekday" class="form-control @error('weekday') is-invalid @enderror" name="weekday">
                                <option label="-- wybierz dzień tygodnia -- "></option>
                                @foreach ($weekdays as $weekday)
                                    @if ($weekday == $defaultWeekday)
                                        <option value="{{ $weekday }}" selected="selected">{{ $weekday }}</option>
                                    @else
                                        <option value="{{ $weekday }}">{{ $weekday }}</option>
                                    @endif

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
                            <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $defaultTime }}" autocomplete="time">

                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="room_id" class="col-md-4 col-form-label text-md-right">{{ __('Sala') }}</label>

                        <div class="col-md-6">
                            <select id="room_id" class="form-control @error('room_id') is-invalid @enderror" name="room_id" required>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>

                            @error('room_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" title="Dodaj nowy przedmiot">
                                {{ __('Dodaj') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($subjects->count() > 0)

                <div class="card-body card-custom">
                    <span class="sort-span"> Grupuj: </span>
                    <input type="hidden" id="groupBy-hidden" value="{{ $grouped_by }}">
                    <select id="group-select" class="form-control form-custom" name="group-select">
                        <option value="{{ route('user_subjects', ['weekday']) }}"> po dniu tygodnia </option>
                        <option value="{{ route('user_subjects', ['name']) }}"> po nazwie </option>
                        <option value="{{ route('user_subjects', ['time']) }}"> po godzinie </option>
                        <option value="{{ route('user_subjects', ['room_id']) }}"> po sali </option>
                    </select>
                </div>

                <div class="card-body">
                    @foreach ($subjects_grouped as $subject_group_name => $subjects_list)
                        @if($subject_group_name)
                            @if($grouped_by == 'room_id')
                                <h5 class="card-title"> {{ App\Room::find($subject_group_name)->name }} <span class="badge badge-secondary" title="Liczba przedmiotów"> {{ $subjects_list->count() }} </span></h5>
                            @else
                                <h5 class="card-title"> {{ $subject_group_name }} <span class="badge badge-secondary" title="Liczba przedmiotów"> {{ $subjects_list->count() }} </span></h5>
                            @endif
                        @else
                            <h5 class="card-title"> Inne <span class="badge badge-secondary" title="Liczba przedmiotów"> {{ $subjects_list->count() }} </span></h5>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless custom-table">
                                <tr class="thead-dark">
                                    <th> Nazwa </th>
                                    <th> Dzień tygodnia </th>
                                    <th> Godzina </th>
                                    <th> Sala </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($subjects_list as $subject)
                                    <tr class="editable" id="tr-editable-{{ $subject->id }}">
                                        <td class="editable-name"> {{ $subject->name }} </td>
                                        <td class="editable-weekday"> {{ $subject->weekday }} </td>
                                        <td class="editable-time"> {{ $subject->time }} </td>
                                        <td class="editable-room"> {{ App\Room::find($subject->room_id)->name }} </td>
                                        <td>
                                            <button type="button" name="edit-subject-btn" class="btn btn-secondary edit-subject-btn" title="Edytuj przedmiot"> <i class="fa fa-pencil"></i> Edytuj </button>
                                        </td>
                                        <td>
                                            <button type="button" name="delete-subject-btn" class="btn btn-danger" data-toggle="modal" data-target="#subjectConfirmationModal-{{ $subject->id }}" title="Usuń przedmiot">  <i class="fa fa-trash-o"></i> Usuń </button>
                                        </td>
                                    </tr>
                                    <tr class="edit-subject-tr d-none table-light p-0" id="tr-editing-{{ $subject->id }}">
                                        <td colspan="7" class="p-0 table-light">
                                            <form method="POST" action="{{ route('user_edit_subject') }}">
                                                @csrf
                                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                                <div class="table-responsive">
                                                    <table class="table custom-table m-0">
                                                        <tr class="table-light">
                                                            <td title="Nazwa przedmiotu">
                                                                <input type="text" class="form-control @error('name_e') is-invalid @enderror edit-name-input" name="name_e" value="{{ $subject->name }}"  autocomplete="name_e" required>
                                                                @error('name_e')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </td>
                                                            <td title="Dzień tygodnia">
                                                                <select class="form-control @error('weekday_e') is-invalid @enderror edit-weekday-input" name="weekday_e">
                                                                    <option label="-- wybierz -- "></option>
                                                                    @foreach ($weekdays as $weekday)
                                                                        @if ($weekday == $subject->weekday)
                                                                            <option value="{{ $weekday }}" selected="selected">{{ $weekday }}</option>
                                                                        @else
                                                                            <option value="{{ $weekday }}">{{ $weekday }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('weekday_e')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </td>
                                                            <td title="Godzina">
                                                                <input type="time_e" class="form-control @error('time_e') is-invalid @enderror edit-time-input" name="time_e" value="{{ $subject->time }}" autocomplete="time_e">
                                                                @error('time_e')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </td>
                                                            <td title="Sala">
                                                                <select class="form-control @error('room_id_e') is-invalid @enderror edit-room-input" name="room_id_e" required>
                                                                    @foreach ($rooms as $room)
                                                                        @if ($room->id == $subject->room_id)
                                                                            <option value="{{ $room->id }}" selected="selected">{{ $room->name }}</option>
                                                                        @else
                                                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('room_id_e')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <button type="button" name="edit-subject-btn-cancel" class="btn btn-secondary edit-subject-btn-cancel" title="Anuluj zmiany"> <i class="fa fa-times"></i> Anuluj </button>
                                                            </td>
                                                            <td>
                                                                <button type="submit" name="edit-subject-btn-save" class="btn btn-primary edit-subject-btn-save" title="Zapisz zmiany"> <i class="fa fa-pencil"></i> Zapisz </button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('user.delete_confirmation_subject', [$subject])
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-body">
                    <p> Brak przedmiotów. </p>
                </div>
            @endif
        </div>
    </div>
@endsection
