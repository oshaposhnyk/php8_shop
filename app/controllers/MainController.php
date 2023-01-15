<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Title', 'Desc', 'keywords');
        $this->set(['test' => 'var']);
    }
}