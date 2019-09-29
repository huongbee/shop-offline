<?php
require_once 'DBConnect.php';

class CartModel extends DBConnect
{
    function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id=$id";
        return $this->getOneRow($sql);
    }
}
