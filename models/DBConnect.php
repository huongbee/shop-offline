<?php
class DBConnect
{
    private $dbh;
    private $stmt;
    function __construct() // auto run
    {
        try {
            $this->dbh = new PDO('mysql:dbname=php0205;host=127.0.0.1', 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }
    function executeQuery($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
        $check = $this->stmt->execute(); // check query 
        return $check; // bool
    }
    function getOneRow($sql)
    {
        $check = $this->executeQuery($sql);
        if ($check === true) return $this->stmt->fetch(PDO::FETCH_OBJ); // get data
        return false;
    }
    function getMoreRows($sql)
    {
        $check = $this->executeQuery($sql);
        if ($check === true) return $this->stmt->fetchAll(PDO::FETCH_OBJ); // get data
        return false;
    }
}

// $d = new DBConnect;

// $sql = 'SELECT * FROM products WHERE id =2';
// $r = $d->getMoreRows($sql);
// print_r($r);
