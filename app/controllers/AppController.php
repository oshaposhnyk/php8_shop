<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\Language;
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
//        debug(App::$app->getProperty("language", 1));
    }
}