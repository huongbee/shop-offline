<?php
require_once 'controllers/BaseController.php';
class DetailController extends BaseController
{
    function getDetailPage()
    {
        return $this->callView('detail');
    }
}
