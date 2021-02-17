<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scrs/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/lib/simple_html_dom.php';

$db = new \classes\DB();
$pagination = new \classes\Pagination();
$articles = new \classes\Article();

/*
 * контент страницы
 */
$curl = new \Curl\Curl();
$curl->get('https://habr.com/ru/');
$html = new simple_html_dom();
$html->load($curl->response);

foreach($html->find('a.post__title_link') as $key => $article) {
    preg_match('|.*(\d{6,11})|', $article->href, $matches);
    $id = $matches[1];
    if(!isset($articles->last()[$id])) {
        /*
         * контент страницы
         */
        $curl = new \Curl\Curl();
        $curl->get($article->href);
        $html = new simple_html_dom();
        $html->load($curl->response);

        /*
         * переменные
         */
        $title = $article->plaintext;
        $url = $article->href;
        $text = $html->find('#post-content-body', 0)->innertext;

        /*
         * insert
         */
        $insert = [
            'id' => $id,
            'title' => $title,
            'url' => $url,
            'text' => $text,
        ];
        $articles->insert($insert);
    }
    if($key==LIMIT) break;
}

echo $articles->items();
echo $pagination->pagination($articles->count());
?>