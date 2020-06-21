@extends('home')

@section('title') Mój Panel - Obecności @endsection

@section('user_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header custom-header">
                <h4> Wszystkie obecności <span class="badge badge-secondary" title="Liczba wszystkich obecności"> {{ $attendances->count() }} </span> </h4>
                <div>
                    @if ($attendances->count() > 0)
                        <a href="{{ route('user_export_grouped', [$grouped_by]) }}" class="btn btn-success btn-export" title="Wyeksportuj wszystko do xlsx"> <i class="fa fa-file-excel-o"></i> Wyeksportuj (.xlsx) </a>
                    @endif
                    <button type="button" class="btn btn-primary add-attendance-btn" title="Dodaj nowy wpis"> <i class="fa fa-plus"></i> Dodaj nowy wpis </button>
                </div>
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
             <div class="card-body add-attendance">
                 <h5> Dodaj obecność </h5>
                 <form method="POST" action="{{ route('user_add_attendance') }}" class="col-md-12">
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
                         <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Nr indeksu') }}</label>

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
                         <label for="student_name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label>

                         <div class="col-md-6">
                             <input id="student_name" type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" value="{{ old('student_name') }}" required autocomplete="student_name">

                             @error('student_name')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="student_surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

                         <div class="col-md-6">
                             <input id="student_surname" type="text" class="form-control @error('student_surname') is-invalid @enderror" name="student_surname" value="{{ old('student_surname') }}" required autocomplete="student_surname">

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
                             <input id="seat_number" type="number" class="form-control @error('seat_number') is-invalid @enderror" name="seat_number" value="{{ old('seat_number') }}" autocomplete="seat_number">

                             @error('seat_number')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Notatka') }}</label>

                         <div class="col-md-6">
                             <textarea id="note" class="form-control" name="note"></textarea>

                             @error('note')
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                             <button type="submit" class="btn btn-primary" title="Dodaj nowy wpis">
                                 {{ __('Dodaj') }}
                             </button>
                         </div>
                     </div>
                 </form>
             </div>

             @if ($attendances->count() > 0)
                <div class="card-body card-custom">
                    <span class="sort-span"> Grupuj: </span>
                    <input type="hidden" id="groupBy-hidden" value="{{ $grouped_by }}">
                    <select id="group-select" class="form-control form-custom" name="group-select">
                        <option value="{{ route('user_attendances', ['classes_id']) }}"> po nazwie zajęć </option>
                        <option value="{{ route('user_attendances', ['student_id_number']) }}"> po numerze indeksu </option>
                        <option value="{{ route('user_attendances', ['seat_number']) }}"> po numerze miejsca </option>
                    </select>
                </div>

                <div class="card-body">
                @foreach ($attendances_grouped as $attendances_group_name => $attendances_list)
                    @if($attendances_group_name)
                        @if($grouped_by == 'classes_id')
                            <h5 class="card-title"> {{ App\Subject::find(App\Classes::find($attendances_group_name)->subject_id)->name }},
                                {{ App\Classes::find($attendances_group_name)-> date }} {{ App\Subject::find(App\Classes::find($attendances_group_name)->subject_id)->time }}
                                <span class="badge badge-secondary"  title="Liczba wszystkich obecności"> {{ $attendances_list->count() }}</span> </h5>
                        @else
                                <h5 class="card-title"> {{ $attendances_group_name }} <span class="badge badge-secondary"  title="Liczba wszystkich obecności"> {{ $attendances_list->count() }} </span> </h5>
                        @endif
                    @else
                            <h5 class="card-title"> Inne <span class="badge badge-secondary"  title="Liczba wszystkich obecności"> {{ $attendances_list->count() }}</span></h5>
                    @endif
                    <div class="table-responsive">
                        @include('user.attendances_table', ['attendances_list' => $attendances_list, 'export' => 0])
                    </div>
                @endforeach
                </div>
            @else
                <div class="card-body">
                    <p> Brak zarejestrowantch obecności. </p>
                </div>
            @endif

        </div>
    </div>

@endsection
