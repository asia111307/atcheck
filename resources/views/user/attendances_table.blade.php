<table class="table table-striped table-borderless custom-table">
<tr class="thead-dark">
    <th> Nazwa zajęć </th>
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
@foreach ($attendances_list as $attendance)
    <tr>
        <td> {{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->name }},
            {{ App\Classes::find($attendance->classes_id)-> date }} {{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->time }}, sala {{ App\Room::find(App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->room_id)->name }} </td>
        <td> {{ $attendance->student_id_number }} </td>
        <td> {{ $attendance->student_surname}}</td>
        <td> {{ $attendance->student_name}}</td>
        <td> {{ $attendance->seat_number }} </td>
        @if(!$export == 1)
            @if(!$attendance->notes)
                <td>
                    <button type="button" name="note-attendance-btn" class="btn btn-primary" data-toggle="modal" data-target="#noteModal-{{ $attendance->id }}" title="Dodaj notatkę"> <i class="fa fa-plus"></i>  Dodaj notatkę </button>
                </td>
            @else
                <td>
                    <button type="button" name="note-attendance-btn" class="btn btn-secondary" data-toggle="modal" data-target="#noteModal-{{ $attendance->id }}" title="Edytuj notatkę"> <i class="fa fa-pencil"></i> Edytuj notatkę </button>
                </td>
            @endif
            <td>
                <button type="button" name="delete-attendance-btnc" class="btn btn-danger" data-toggle="modal" data-target="#attendanceConfirmationModal-{{ $attendance->id }}" title="Usuń wpis">  <i class="fa fa-trash-o"></i> Usuń </button>
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
