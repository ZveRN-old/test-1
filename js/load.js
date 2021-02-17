// кнопка загрузить
$(document).on('click', '#load', function () {
    // включаю загрузку
    $(this).append('<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>');

    // парсер
    $.post("/js/ajax/load.php",
        {
            page: 1
        },
        onAjaxParserSuccess
    );
    function onAjaxParserSuccess(data) {
        // на главную страницу
        history.pushState({}, '', '/');

        // добавляю контент
        $('.content').html(data);

        // убираю загрузку
        $('#load .spinner-border').remove();

        return false;
    }
});