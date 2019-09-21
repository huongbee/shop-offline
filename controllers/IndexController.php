<?php
require_once 'controllers/BaseController.php';
require_once 'models/IndexModel.php';

class IndexController extends BaseController
{
    function getHomePage()
    {
        $m = new IndexModel;
        $featuredProducts = $m->getFeaturedProduct();
        // print_r($featuredProducts);
        $view = 'home';
        $data = ['featuredProducts' => $featuredProducts];
        return $this->callView($view, $data);
    }
}
