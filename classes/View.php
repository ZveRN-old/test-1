<?php
namespace classes;

class View
{
    public function render($view, $data = []) {
        extract($data);
        ob_start();
        include( $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $view);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}