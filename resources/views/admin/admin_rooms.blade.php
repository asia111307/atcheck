@extends('layouts.adminpanel')

@section('title') Admin Panel - Rooms @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5> Add new room </h5>
            <form method="POST" action="{{ route('admin_add_room') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                    <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('Capacity') }}</label>

                    <div class="col-md-6">
                        <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" autocomplete="capacity">

                        @error('capacity')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="arrangement" class="col-md-4 col-form-label text-md-right">{{ __('Arrangement') }}</label>

                    <div class="col-md-6">
                        <input id="arrangement" type="text" class="form-control @error('arrangement') is-invalid @enderror" name="arrangement" value="{{ old('arrangement') }}" autocomplete="arrangement">

                        @error('arrangement')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                    </div>
                </div>
            </form>
            @if ($rooms->count() > 0)
                <h5> All rooms: ({{ $rooms->count() }}) </h5>
                <table class="table table-striped">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th> Name </th>
                        <th> Capacity </th>
                        <th> Arrangement </th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($rooms as $room)
                        <tr>
                            <td> {{ $room->id }}</td>
                            <td> {{ $room->name }} </td>
                            <td> {{ $room->capacity }} </td>
                            <td> {{ $room->arrangement}}</td>
                            <td>
                                <a href="{{ route('admin_delete_room', [$room->id]) }}" name="delete-room-btn" class="btn btn-danger"> Delete </a>
                            <td>
                                <a href="{{ route('admin_edit_room', [$room->id]) }}" name="edit-room-btn" class="btn btn-secondary"> Edit </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p> No rooms yet. </p>
            @endif
        </div>
    </div>
@endsection
