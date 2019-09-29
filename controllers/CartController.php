<?php
require_once 'controllers/BaseController.php';
require_once 'models/CartModel.php';

class CartController extends BaseController
{
    function addToCart()
    {
        $id = $_POST['idProduct'];
        $m = new CartModel();
        $p = $m->getProduct($id);
        print_r($p);
    }
}
