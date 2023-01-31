<?php

namespace app\models;

use core\App;

class Breadcrumbs extends AppModel
{
    public static function getBreadCrumbs(int $categoryId, string $name = ''): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $breadcrumbs_arr = self::getParts($categories, $categoryId);
        $breadcrumbs = "<li class='breadcrumb-item'><a href='". baseUrl() ."'>Home</a> </li>";

        if ($breadcrumbs_arr) {
            foreach ($breadcrumbs_arr as $alias => $title) {
                $breadcrumbs .= "<li class='breadcrumb-item'> <a href='category/{$alias}'>{$title}</a> </li>";
            }
        }

        if ($name) {
            $breadcrumbs .= "<li class='breadcrumb-item active'> $name </li>";
        }

        return $breadcrumbs;
    }

    public static function getParts(array $cats, int $id): array|false
    {
        if (!$id) return false;
        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['slug']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else {
                break;
            }
        }

        return array_reverse($breadcrumbs, true);
    }
}