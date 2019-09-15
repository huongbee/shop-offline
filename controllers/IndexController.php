<?php
require_once 'controllers/BaseController.php';
class IndexController extends BaseController
{
    function getHomePage()
    {
        return $this->callView('home');
    }
}
