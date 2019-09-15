<?php
class BaseController
{
    function callView($view = 'home')
    {
        require_once 'views/layout.php';
    }
}
