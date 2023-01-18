<?php

namespace app\controllers;

use app\models\Main;
use core\App;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends AppController
{
    public function indexAction()
    {
        $slides = R::findAll('slider');
        $products = $this->model->getHits(1, 3);
        $this->setMeta(App::$app->getProperty('site_name') . ' - Home', 'Desc', 'keywords');
        $this->set(['slides' => $slides, 'products' => $products]);
    }
}