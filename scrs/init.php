<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

/*
 * константы
 */
if(isset($_GET['page'])) {
    define("PAGE", $_GET['page']);
}
else {
    define("PAGE", 1);
}
define("LIMIT", 5); // количество статей на странице
define("SITE_URL", explode('?', $_SERVER['REQUEST_URI'])[0]);

/*
 * классы
 */
require $_SERVER['DOCUMENT_ROOT'].'/classes/DB.php';
require $_SERVER['DOCUMENT_ROOT'] . '/classes/Pagination.php';
require $_SERVER['DOCUMENT_ROOT'].'/classes/View.php';
require $_SERVER['DOCUMENT_ROOT'].'/classes/Article.php';
?>