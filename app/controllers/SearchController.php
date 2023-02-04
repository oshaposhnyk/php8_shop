<?php

namespace app\controllers;

use app\models\Search;
use core\App;
use core\Pagination;

/** @property Search $model */
class SearchController extends AppController
{
    public function indexAction()
    {
        $s = get('s', 's');
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perPage = App::$app->getProperty('pagination');

        $total = $this->model->getCountFindProducts($s, $lang);
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();
        $products = $this->model->getFindProducts($s, $lang, $start, $perPage);

        $this->setMeta("Search");
        $this->set(['s' => $s, 'products' => $products, 'pagination' => $pagination, 'total' => $total]);
    }
}