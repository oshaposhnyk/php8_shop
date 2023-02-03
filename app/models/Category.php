<?php

namespace app\models;

use core\App;
use RedBeanPHP\R;

class Category extends AppModel
{
    public function getCategory(string $slug, array $lang):array
    {
        return R::getRow(
            "SELECT c.*, cd.* FROM category c 
                JOIN category_description cd 
                ON c.id = cd.category_id 
                WHERE slug = ? AND cd.language_id = ?", [$slug, $lang['id']]
        );
    }

    public function getIds(int $id): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $ids = '';
        foreach ($categories as $k => $v) {
            if ($v['parent_id'] == $id) {
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }

        return $ids;
    }

    public function getProducts(string $ids, $lang, int $start, int $perPage): array
    {
        $sortValues = [
            'title_asc' => 'ORDER BY title ASC',
            'title_desc' => 'ORDER BY title DESC',
            'price_asc' => 'ORDER BY price ASC',
            'price_desc' => 'ORDER BY price DESC',
        ];

        $orderBy = '';

        if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $sortValues)) {
            $orderBy = $sortValues[$_GET['sort']];
        }

        return R::getAll(
            "SELECT p.*, pd.* FROM product p
                JOIN product_description pd
                ON p.id = pd.product_id
                WHERE p.status = 1 AND p.category_id IN ($ids) AND pd.language_id = ?
                $orderBy LIMIT $start, $perPage", [$lang['id']]);
    }

    public function getCountProducts(string $ids): int
    {
        return R::count('product', "category_id IN ($ids) AND status = 1");
    }
}