<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use core\App;
use core\Pagination;
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

        $page = abs(get('page')) ?: 1;
        $perPage = App::$app->getProperty('pagination');
        $total = $this->model->getCountProducts($ids);

        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();
        $products = $this->model->getProducts($ids, $lang, $start, $perPage);


        $this->setMeta($category['title'], $category['description'] ?? '', $category['keywords']);
        $this->set([
            'products' => $products,
            'breadcrumbs' => $breadcrumbs,
            'category' => $category,
            'pagination' => $pagination,
            'total' => $total
        ]);
    }


}