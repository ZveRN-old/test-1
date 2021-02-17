<?php
namespace classes;

class Pagination
{
    private $href;
    private $page;
    private $count_pages;

    public function __construct() {
        $this->view = new View();
    }

    public function pagination($count_items) {
        $this->href = '?page=';

        $this->count_pages = ceil($count_items / LIMIT);

        if(is_numeric($_POST['page']) && $_POST['page']>0) {
            $this->page = $_POST['page'];
        }
        else {
            $this->page = PAGE;
        }

        $i = 1;

        if($this->count_pages>9) {
            if ($this->page < 6) {
                $this->count_pages = 9;
            }
            else if ($this->count_pages - $this->page > 4) {
                $this->count_pages = $this->page + 4;
                $i = $this->page - 4;
            }
            else {
                $i = $this->count_pages - 8;
            }
        }

        /*
         * prev
         */
        if($this->page<2) {
            $activ = ' disabled';
        }
        else {
            $activ = null;
        }
        $content = $this->prev($activ);

        /*
         * numbers
         */
        for($i;$i<=$this->count_pages;$i++) {
            if($i==$this->page || ($this->page==1 && $i==1)) {
                $activ = ' disabled';
            }
            else {
                $activ = null;
            }
            $content .= $this->item($i, $activ);
        }

        /*
         * next
         */
        if($this->page==$this->count_pages || $this->count_pages<2) {
            $activ = ' disabled';
        }
        else {
            $activ = null;
        }
        $content .= $this->next($activ);

        return $this->view->render('views/pagination/_content.php', array(
            'content' => $content,
        ));
    }

    private function item($num, $activ = null) {
        if($num==1) {
            $href ='/';
        }
        else {
            $href = $this->href.$num;
        }

        return $this->view->render('views/pagination/_item.php', array(
            'activ' => $activ,
            'href' => $href,
            'num' => $num,
        ));
    }

    private function prev($activ = null) {
        if($this->page>2) {
            $href = $this->href.($this->page - 1);
        }
        else if($this->page==2) {
            $href = '/';
        }
        else {
            $href = SITE_URL;
        }

        return $this->view->render('views/pagination/_prev.php', array(
            'activ' => $activ,
            'href' => $href,
        ));
    }

    private function next($activ = null) {
        $href = $this->href.($this->page + 1);

        return $this->view->render('views/pagination/_next.php', array(
            'activ' => $activ,
            'href' => $href,
        ));
    }
}