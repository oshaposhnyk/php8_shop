<?php

namespace app\controllers;

use app\models\User;

/** @property User $model */
class UserController extends AppController
{
    public function signupAction()
    {
        if ($this->model::checkAuth()) {
            redirect(baseUrl());
        }

        if (!empty($_POST)) {
            $data = $_POST;
            $this->model->load($data);

        }
        $this->setMeta(l('tpl_signup'));
    }
}