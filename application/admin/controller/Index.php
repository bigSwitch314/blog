<?php
namespace app\admin\controller;
use app\admin\controller\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return $this->fetch('index');
    }

}
