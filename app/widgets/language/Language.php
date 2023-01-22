<?php

namespace app\widgets\language;

use core\App;
use RedBeanPHP\R;

class Language
{
    protected $tpl;
    protected array $languages;
    protected array $language;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/lang_tpl.php';
        $this->run();
    }

    public function run(): void
    {
        $this->languages = App::$app->getProperty('languages');
        $this->language = App::$app->getProperty('language');
        echo $this->getHtml();
    }

    public static function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
    }

    public static function getLanguage($languages): array|null
    {
        $lang = App::$app->getProperty('lang');
        if ($lang && array_key_exists($lang, $languages)) {
            $key = $lang;
        } elseif (!$lang) {
            $key = key($languages);
        } else {
            $lang = h($lang);
            throw new \Exception("Not found language {$lang}", 404);
        }

        $langInfo = $languages[$key];
        $langInfo['code'] = $key;

        return $langInfo;
    }

    protected function getHtml(): string
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }


}