<?php
require $_SERVER['DOCUMENT_ROOT'] . '/scrs/init.php';

if(is_numeric($_POST['id']) && $_POST['id']>0) {
    $model = new \classes\Article();
    echo $model->text($_POST['id']);
}
?>