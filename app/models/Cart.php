<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{
    public function getProducts(int $id, array $lang): array
    {
        return R::getRow("
            SELECT p.*, pd.* 
            FROM product p 
            JOIN product_description pd
            ON p.id = pd.product_id
            WHERE p.status = 1 AND p.id = ? AND pd.language_id = ?
        ", [$id, $lang['id']]);
    }

    public function addToCart($product, $qty = 1): bool
    {
        $qty = abs($qty);

        if ($product['is_download'] && isset($_SESSION['cart'][$product['id'] ])) {
            return false;
        }

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                $qty = 1;
            }

            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
                'is_download' => $product['is_download']
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? !empty($_SESSION['cart.qty']) + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? !empty($_SESSION['cart.sum']) + $qty * $product['price'] : $qty * $product['price'];

        return true;
    }
}