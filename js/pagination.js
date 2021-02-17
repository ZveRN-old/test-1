// пагинация
$(document).on('click', 'a.page-link', function () {
    var page = $(this).attr('href');

    // меняю url
    history.pushState({}, '', page);

    // текущая страница
    var this_page = parseInt(location.search.replace('?page=',''));
    if(isNaN(this_page)) {
        this_page = 1;
    }

    // заменяю контент
    $.post("/js/ajax/pagination.php",
        {
            page: this_page
        },
        onAjaxSuccess
    );
    function onAjaxSuccess(data) {
        $('.content').html(data);
    }

    return false;
});