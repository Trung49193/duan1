<?php
class mainModel{
    public $conn;
    function __construct() {
        $this->conn = connDBAss();
    }
    function topProduct() {
        $sql="SELECT * FROM products order by view desc limit 8";
        return $this->conn->query($sql)->fetchAll();
    }
}