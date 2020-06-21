<div class="modal fade" id="noteModal-{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="noteModal-{{ $attendance->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>{{ $attendance->student_name }} {{ $attendance->student_surname }} ({{ $attendance->student_id_number }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user_add_attendance_note') }}">
                    @csrf

                    <input type="hidden" class="form-control" name="attendance_id" value="{{ $attendance->id }}" required>
                    <input type="hidden" id="note_content_hidden-{{ $attendance->id }}" name="note_content_hidden" value="{{ $attendance->notes }}">
                    <div class="form-group">
                        <label for="note_content-{{ $attendance->id }}" class="col-form-label">Treść notatki:</label>
                        <textarea class="form-control" id="note_content-{{ $attendance->id }}" name="note_content">{{ $attendance->notes }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Anuluj"> Anuluj </button>
                        <button type="submit" class="btn btn-primary" title="Zapisz notatkę"> Zapisz </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
