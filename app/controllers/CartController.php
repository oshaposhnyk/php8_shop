<?php

namespace app\controllers;

use app\models\Cart;
use core\App;
use JetBrains\PhpStorm\NoReturn;

/** @property Cart $model */
class CartController extends AppController
{
    public function addAction(): bool
    {
        $lang = $this->lang;
        $id = get('id');
        $qty = get('qty');

        if (!$id) {
            return false;
        }
        $product = $this->model->getProducts($id, $lang);
        if (!$product) {
            return false;
        }

        $this->model->addToCart($product, $qty);

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }

        redirect();
        return true;
    }

    #[NoReturn] public function showAction(): void
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = get('id');

        if (isset($_SESSION['cart'][$id])) {
            $this->model->deleteItem($id);
        }

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }

        redirect();
    }

    public function clearAction(): bool
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }

        $this->model->clearCart();
        $this->loadView('cart_modal');


        return true;
    }
}
