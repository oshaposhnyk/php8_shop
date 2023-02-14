<?php

namespace app\controllers;

use app\models\Page;
use core\Controller;

/**
 * @property Page $model
 */
class PageController extends AppController
{


    public function viewAction()
    {
        $lang = $this->lang;
        $page = $this->model->getPage($this->route['slug'], $lang);

        if (!$page) {
            $this->eror404();
            return;
        }

        $this->setMeta($page['title'], $page['description'] ?? '', $page['keywords']);
        $this->set(['page' => $page]);

    }//end viewAction()


}//end class
