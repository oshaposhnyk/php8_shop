<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends AppController
{
    public function indexAction()
    {
        $slides = R::findAll('slider');
        $products = $this->model->getHits(1, 3);
        $this->setMeta('Title', 'Desc', 'keywords');
        $this->set(['slides' => $slides, 'products' => $products]);
    }
}