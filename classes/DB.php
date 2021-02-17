<?php
namespace classes;

class DB
{
    public $db;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "123456";
        $dbname = "habr";

        $this->db = mysqli_connect($host, $user, $password, $dbname);
    }

    public function query($sql, $args = NULL)
    {
        if (!$args)
        {
            return $this->db->query($sql);
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function __destruct() {
        $this->db = NULL;
    }
}