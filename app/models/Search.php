<?php

namespace app\models;

use RedBeanPHP\R;

class Search extends AppModel
{
    public function getCountFindProducts(string $s, array $lang): int
    {
        return R::getCell(
            "SELECT COUNT(*) FROM product p
                JOIN product_description pd ON p.id = pd.product_id
                WHERE status = 1 AND pd.language_id = ? AND pd.title LIKE ?",
            [$lang['id'], "%$s%"]
        );
    }

    public function getFindProducts(string $s, array $lang, int $start, $perPage): array
    {
        return R::getAll(
            "SELECT p.*, pd.* FROM product p
                JOIN product_description pd on p.id = pd.product_id 
                WHERE p.status = 1 AND pd.language_id = ? AND pd.title LIKE ? LIMIT $start, $perPage",
            [$lang['id'], "%$s%"]
        );
    }
}
