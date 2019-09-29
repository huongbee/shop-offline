<?php
require_once 'controllers/BaseController.php';
require_once 'models/CartModel.php';
require_once 'helpers/Cart.php';
session_start();

class CartController extends BaseController
{
    function addToCart()
    {
        $id = $_POST['idProduct'];
        $m = new CartModel();
        $product = $m->getProduct($id);
        $qty = 1;
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $qty);
        $_SESSION['cart'] = $cart;

        print_r($_SESSION['cart']);
    }
}
