<table class="table table-borderless custom-table">
    <tr class="thead-light">
        <th> Nr indeksu </th>
        <th> Nazwisko </th>
        <th> Imię </th>
        <th> Nr miejsca </th>
        @if(!$export == 1)
            <th></th>
            <th></th>
        @else
            <th> Notatka </th>
        @endif
    </tr>
    @foreach ($attendances as $attendance)
        <tr class="attendance-id" id="{{ $attendance->seat_number }}++{{ $attendance->student_name}}++{{ $attendance->student_surname}}">
            <td> {{ $attendance->student_id_number }} </td>
            <td> {{ $attendance->student_surname}}</td>
            <td> {{ $attendance->student_name}}</td>
            <td> {{ $attendance->seat_number }} </td>
            @if(!$export == 1)
                @if(!$attendance->notes)
                    <td>
                        <button type="button" name="note-attendance-btn" class="btn btn-primary" data-toggle="modal" data-target="#noteModal-{{ $attendance->id }}" title="Dodaj notatkę"> <i class="fa fa-plus"></i> <i class="fa fa-sticky-note"></i> </button>
                    </td>
                @else
                    <td>
                        <button type="button" name="note-attendance-btn" class="btn btn-secondary" data-toggle="modal" data-target="#noteModal-{{ $attendance->id }}" title="Edytuj notatkę"> <i class="fa fa-pencil"></i> <i class="fa fa-sticky-note"></i> </button>
                    </td>
                @endif
                <td>
                    <button type="button" name="delete-attendance-btn" class="btn btn-danger" data-toggle="modal" data-target="#attendanceConfirmationModal-{{ $attendance->id }}" title="Usuń wpis">  <i class="fa fa-trash-o"></i></button>
                </td>
            @else
                <td>
                    {{ $attendance->notes }}
                </td>
            @endif
        </tr>
        @include('user.attendance_note', [$attendance])
        @include('user.delete_confirmation_attendance', [$attendance])
    @endforeach
</table>

