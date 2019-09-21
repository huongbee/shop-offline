<?php
class BaseController
{
    function callView($view = 'home', $data = [])
    {
        require_once 'views/layout.php';
    }
}
