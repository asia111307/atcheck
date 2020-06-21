<div class="modal fade" id="attendanceConfirmationModal-{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="attendanceConfirmationModal-{{ $attendance->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5> Usuwanie wpisu obecności </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Czy na pewno chcesz usunąć obecność studenta <b>{{ $attendance->student_name }} {{ $attendance->student_surname }}</b>
                    (numer indeksu <b>{{ $attendance->student_id_number }}</b>) z zajęć <b>{{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->name }}</b>
                    które odbyły się <b>{{ App\Classes::find($attendance->classes_id)-> date }}</b> o godzinie <b>{{ App\Subject::find(App\Classes::find($attendance->classes_id)->subject_id)->time }}</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Anuluj"> Anuluj </button>
                <a href="{{ route('user_delete_attendance', [$attendance->id]) }}" name="delete-attendance-btn-{{ $attendance->id }}" class="btn btn-danger" title="Usuń wpis"> Tak, usuń </a>
            </div>
        </div>
    </div>
</div>
