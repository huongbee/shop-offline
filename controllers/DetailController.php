<?php
require_once 'controllers/BaseController.php';
class DetailController extends BaseController
{
    function getDetailPage()
    {
        $url = $_GET['url'];

        return $this->callView('detail');
    }
}
