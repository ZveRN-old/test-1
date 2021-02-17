// модалка
$(document).on('click', 'button.full', function () {
    var value = $(this).attr('value');
    // получаю текст статьи
    $.post("/js/ajax/modal.php",
        {
            id: value
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data) {
        $('.modal-text').html(data);
        // вызываю модальное окно
        $("#modalFull").modal('show');
    }
});