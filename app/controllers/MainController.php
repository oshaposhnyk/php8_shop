<?php

namespace app\controllers;

use app\models\Main;
use core\Controller;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends Controller
{
    public function indexAction()
    {
        $names = $this->model->getNames();
        
        debug($names);
        $this->setMeta('Title', 'Desc', 'keywords');
        $this->set(['test' => 'var']);
    }
}