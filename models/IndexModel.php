<?php
require_once 'DBConnect.php';

class IndexModel extends DBConnect
{
    function getFeaturedProduct()
    {
        $sql = 'SELECT * FROM products WHERE status=1';
        return $this->getMoreRows($sql);
    }
}
