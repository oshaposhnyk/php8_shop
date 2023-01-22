<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
use core\App;
use core\Controller;

class AppController extends Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty("languages", Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(Language::getLanguages()));

        $lang = App::$app->getProperty('language');
        \core\Language::load($lang['code'], $this->route);

    }
}