<?php

namespace app\controllers;

use app\models\Cart;
use core\App;

/** @property Cart $model */
class CartController extends AppController
{
    public function addAction(): bool
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');

        if(!$id) {
            return false;
        }
        $product = $this->model->getProducts($id, $lang);
        if(!$product) {
            return false;
        }

        $this->model->addToCart($product, $qty);

        if ($this->isAjax()) {
            debug($_SESSION['cart']);
            die();
        }

        redirect();
        return true;

    }
}