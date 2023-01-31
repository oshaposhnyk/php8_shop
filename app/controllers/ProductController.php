<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;
use core\App;

class ProductController extends AppController
{
    /** @property Product $model */
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');

        $product = $this->model->getProduct($lang, $this->route['slug']);

        if (!$product) {
//            throw new \Exception('Product not found', 404);
            $this->eror404();
            return;
        }

        $gallery = $this->model->getGallery($product['id']);

        $breadcrumbs = Breadcrumbs::getBreadCrumbs($product['category_id'], $product['title']);

        $this->setMeta($product['title'], (string) $product['description'], $product['keywords']);

        $this->set(['product' => $product, 'gallery' => $gallery, 'breadcrumbs' => $breadcrumbs]);
    }
}