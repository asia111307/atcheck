<div class="modal fade" id="subjectConfirmationModal-{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="subjectConfirmationModal-{{ $subject->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5> Usuwanie przedmiotu </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Czy na pewno chcesz usunąć przedmiot <b>{{ $subject->name }}</b>?
                    <br><br> Dzień i godzina przedmiotu:
                    <br> {{ $subject->weekday }}, godzina {{ $subject->time }} w sali {{ App\Room::find($subject->room_id)->name }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Anuluj"> Anuluj </button>
                <a href="{{ route('user_delete_subject', [$subject->id]) }}" name="delete-subject-btn" class="btn btn-danger hover-btn" title="Usuń przedmiot"> Tak, usuń </a>
            </div>
        </div>
    </div>
</div>
