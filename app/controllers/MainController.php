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
        $products = $this->model->getHits(App::$app->getProperty('language')['id'], 3);
        $this->setMeta(lang('main_index_meta_title'), lang('main_index_meta_description'), 'keywords');
        $this->set(['slides' => $slides, 'products' => $products]);
    }
}