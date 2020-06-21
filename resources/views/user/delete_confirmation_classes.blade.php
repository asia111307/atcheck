<div class="modal fade" id="classesConfirmationModal-{{ $classes_item->id }}" tabindex="-1" role="dialog" aria-labelledby="classesConfirmationModal-{{ $classes_item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5> Usuwanie zajęć </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Czy na pewno chcesz usunąć zajęcia <b>{{ App\Subject::find(App\Classes::find($classes_item->id)->subject_id)->name }}</b>, które odbyły się
                    <b>{{ App\Classes::find($classes_item->id)-> date }}</b> o godzinie <b>{{ App\Subject::find(App\Classes::find($classes_item->id)->subject_id)->time }}</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Anuluj"> Anuluj </button>
                <a href="{{ route('user_delete_classes', [$classes_item->id]) }}" name="delete-classes-btn" class="btn btn-danger" title="Usuń zajęcia"> Tak, usuń </a>
            </div>
        </div>
    </div>
</div>
