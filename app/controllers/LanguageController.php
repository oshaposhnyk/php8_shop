<?php

namespace app\controllers;

use core\App;

class LanguageController extends AppController
{
    public function changeAction()
    {
        $lang = get('lang', 's');

        if($lang) {
            $langs = App::$app->getProperty('languages');
            if (array_key_exists($lang, $langs)) {
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');
                $urlParts = explode('/', $url, 2);
                if(array_key_exists($urlParts[0], $langs)) {
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $urlParts[0] = $lang;
                    } else {
                        array_shift($urlParts);
                    }
                } else {
                    if ($lang != App::$app->getProperty('language')['code']) {
                        array_unshift($urlParts, $lang);
                    }
                }
                $url = PATH . '/' . implode('/', $urlParts);
                redirect($url);
            }
        }

        redirect();
    }
}