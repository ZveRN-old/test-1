<?php
namespace classes;

class Article
{
    public function __construct() {
        $this->view = new View();
        $this->db = new DB();
    }

    /*
     * статья
     */
    public function item($item = []) {
        return $this->view->render('views/articles/_item.php', array(
            'item' => $item,
        ));
    }

    /*
     * список статей
     */
    public function items() {
        if($_POST['page']>0) $start = ($_POST['page'] - 1) * LIMIT;
        else $start = (PAGE - 1) * LIMIT;

        $res = $this->db->query("SELECT * FROM `articles` WHERE 1 ORDER BY `id` DESC LIMIT ".$start.','.LIMIT);
        $items = '';
        if($res->num_rows>0) {
            while($rw = $res->fetch_array(MYSQLI_ASSOC)) {
                $arItem = [
                    'id' => $rw['id'],
                    'title' => $rw['title'],
                    'url' => $rw['url'],
                    'text' => mb_strimwidth(strip_tags($rw['text']), 0, 200, "..."),
                ];
                $items .= $this->item($arItem);
            }
        }
        else {
            return false;
        }

        return $this->view->render('views/articles/_items.php', array(
            'items' => $items,
        ));
    }

    /*
     * текст статьи
     */
    public function text($id) {
        $query = "SELECT `text` FROM `articles` WHERE `id`=" . $id;
        if ($res = $this->db->query($query)) {
            $row = $res->fetch_assoc();
            return $row['text'];
        }
        return false;
    }

    /*
     * общее количество статей
     */
    public function count() {
        $res = $this->db->query("SELECT id FROM articles");
        return $res->num_rows;
    }

    /*
     * последние статьи
     */
    public function last() {
        $res = $this->db->query("SELECT id FROM `articles` WHERE 1 ORDER BY `id` DESC LIMIT ".LIMIT);
        $row = $res->fetch_all(MYSQLI_ASSOC);
        return array_column($row, 'id', 'id');
    }

    /*
     * добавление новой
     */
    public function insert($array = []) {
        $this->db->query("INSERT INTO `articles`(`id`, `title`, `url`, `text`) VALUES ('" . $array['id'] . "','" . $this->db->db->escape_string($array['title']) . "','" . $array['url'] . "','" . $this->db->db->escape_string($array['text']) . "')");
    }
}