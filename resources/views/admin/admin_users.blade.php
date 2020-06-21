@extends('layouts.adminpanel')

@section('title') Panel admina - Prowadzący @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($users->count() > 0)
                <h5> Wszyscy prowadzący: ({{ $users->count() }}) </h5>
                <table class="table table-striped">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th> Imię </th>
                        <th> Nazwisko </th>
                        <th> Email </th>
                        <th> Admin? </th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->id }}</td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->surname }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->is_Admin }} </td>
                            @if (!$user->is_Admin)
                                <td>
                                    <a href="{{ route('admin_delete_user', [$user->id]) }}" name="delete-user-btn" class="btn btn-danger"> Usuń </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin_edit_user', [$user->id]) }}" name="edit-user-btn" class="btn btn-secondary"> Edytuj </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            @else
                <p> Brak prowadzących. </p>
            @endif
        </div>
    </div>
@endsection
