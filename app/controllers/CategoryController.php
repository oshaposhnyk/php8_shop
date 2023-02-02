<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use core\App;
use RedBeanPHP\R;

/** @property Category $model */
class CategoryController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $category = $this->model->getCategory($this->route['slug'], $lang);

        if (!$category) {
            $this->eror404('Page not found!');
            return;
        }

        $breadcrumbs = Breadcrumbs::getBreadCrumbs($category['id']);
        $ids = $this->model->getIds($category['id']);
        $ids = !$ids ? $category['id'] : $ids . $category['id'];
        $products = $this->model->getProducts($ids, $lang);

        $this->setMeta($category['title'], $category['description'] ?? '', $category['keywords']);
        $this->set(['products' => $products, 'breadcrumbs' => $breadcrumbs, 'category' => $category]);
    }


}