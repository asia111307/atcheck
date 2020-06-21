$(document).ready(function(){
    $('.add-mn-btn').on('click', function () {
        $('.card-reader').toggleClass('open');
    });

    $('.add-subject-btn').on('click', function () {
        $('.add-subject').toggleClass('open');
        if ($('.add-subject').first().hasClass('open')) {
            $(this).addClass('btn-danger');
            $(this).html('<i class="fa fa-times"></i> Anuluj');
            $(this).attr('title', 'Anuluj');
        } else {
            $(this).removeClass('btn-danger');
            $(this).html('<i class="fa fa-plus"></i> Dodaj nowy przedmiot');
            $(this).attr('title', 'Dodaj nowy przedmiot');
        }
    });

    $('.add-attendance-btn').on('click', function () {
        $('.add-attendance').toggleClass('open');
        if ($('.add-attendance').first().hasClass('open')) {
            $(this).addClass('btn-danger');
            $(this).html('<i class="fa fa-times"></i> Anuluj');
            $(this).attr('title', 'Anuluj');
        } else {
            $(this).removeClass('btn-danger');
            $(this).html('<i class="fa fa-plus"></i> Dodaj nowy wpis');
            $(this).attr('title', 'Dodaj nowy wpis');
        }
    });

    $(".modal").on("hidden.bs.modal", function(){
        const id = $(this).attr('id').split('-')[1];
        const originalText = $(this).find(`#note_content_hidden-${id}`).first().val();
        $(this).find(`#note_content-${id}`).first().val(originalText);
    });

    $('.edit-subject-btn').on('click', function () {
        $(this).parents('tr.editable').next().toggleClass('d-none');
        $(this).parents('tr.editable').toggleClass('d-none');
    });

    $('.edit-subject-btn-cancel').on('click', function () {
        $(this).parents('tr.edit-subject-tr').prev().toggleClass('d-none');
        $(this).parents('tr.edit-subject-tr').toggleClass('d-none');
    });

    if($('body').find('.invalid-feedback-alert').length > 0) {
        if($('.add-subject').find('.invalid-feedback').length > 0) {
            $('.add-subject-btn').first().click();
        }
        if($('.edit-subject-tr').find('.invalid-feedback').length > 0) {
            let subject_id = $('#subject_id_redirected').val();
            $(`#tr-editable-${subject_id}`).find('.edit-subject-btn').first().click();
        }
    }

    $('#sort-select').on('change', function() {
        $(location).attr('href', $(this).val())
    });

    $('#group-select').on('change', function() {
        $(location).attr('href', $(this).val())
    });
    const classes_code_div = $('#classes-code-div');
    if(classes_code_div){
        $('#copy-btn').on('click', function () {
            const copyText = $('#classes_code_input');
            copyText.select();
            document.execCommand("copy");
            alert("Skopiowano: " + copyText.val());
            copyText.blur();
        });
        setTimeout(function(){
            classes_code_div.remove()
        }, 30000);
    }

    function setSelectedOptionSortAttendances() {
        const orderBy = $('#orderBy-hidden').first().val();
        const orderDirection = $('#orderDirection-hidden').first().val();
        const pattern = `/${orderBy}/${orderDirection}`;
        const options = $('#sort-select').find('option');
        options.each(function() {
            if($(this).val().search(pattern) !== -1) {
                $('#sort-select').val($(this).val());
            }
        });
    }
    setSelectedOptionSortAttendances();

    function setSelectedOptionGroup() {
        const groupBy = $('#groupBy-hidden').first().val();
        const pattern = `/${groupBy}`;
        const options = $('#group-select').find('option');
        options.each(function() {
            if($(this).val().search(pattern) !== -1) {
                $('#group-select').val($(this).val());
            }
        });
    }
    setSelectedOptionGroup();

    $('input[type="checkbox"]').on('change', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
});
