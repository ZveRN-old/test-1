<?php
require $_SERVER['DOCUMENT_ROOT'].'/scrs/init.php';

if(SITE_URL=='/404.php') require $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
else {
    $articles = new \classes\Article();
    $article = $articles->items();
    if($article===false) {
        $title = 'Ошибка, страницы не существует! 404 Not Found';
        header("HTTP/1.0 404 Not Found");
        echo '<meta http-equiv="refresh" content="0;URL=/404.php">';
        die;
    }
    else {
        $content = $articles->items();
        $pagination = new \classes\Pagination();
        $content .= $pagination->pagination($articles->count());
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
}
?>