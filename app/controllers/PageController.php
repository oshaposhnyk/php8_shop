<?php


namespace app\controllers;

use app\models\Page;
use wfm\App;

/** @property Page $model */
class PageController extends AppController
{
    public function viewAction()
    {
        $lang = $this->lang;
        $page = $this->model->getPage($this->route['slug'], $lang);

        if (!$page) {
            $this->error_404();
            return;
        }

        $this->setMeta($page['title'], $page['description'], $page['keywords']);
        $this->set(compact('page'));
    }
}
