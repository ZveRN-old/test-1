<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scrs/init.php';

$articles = new \classes\Article();
$article = $articles->items();
if($article===false) {
    echo '<meta http-equiv="refresh" content="0;URL=/404.php">';
}
else {
    echo $articles->items();
    $pagination = new \classes\Pagination();
    echo $pagination->pagination($articles->count());
}