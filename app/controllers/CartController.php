<?php

namespace app\controllers;

use app\models\Cart;
use core\App;

/** @property Cart $model */
class CartController extends AppController
{
    public function addAction()
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');

        if(!$id) {
            return false;
        }

        var_dump($this->model->getProducts($id, $lang));
        die();
    }
}