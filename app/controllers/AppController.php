<?php

namespace app\controllers;

use app\models\AppModel;
use app\models\Wishlist;
use app\widgets\language\Language;
use core\App;
use core\Controller;
use RedBeanPHP\R;

class AppController extends Controller
{
    protected array $lang;
    /**
     * @throws \Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty("languages", Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(Language::getLanguages()));

        $lang = App::$app->getProperty('language');
        \core\Language::load($lang['code'], $this->route);

        $categories = R::getAssoc(
            "
                SELECT c.*, cd.*
                FROM category c
                JOIN category_description cd
                ON c.id = cd.category_id
                WHERE cd.language_id = ?
                ",
            [$lang['id']]
        );
        App::$app->setProperty("categories_{$lang['code']}", $categories);
        App::$app->setProperty('wishlist', Wishlist::getWishlistIds());
        $this->lang = App::$app->getProperty('language');
    }
}
