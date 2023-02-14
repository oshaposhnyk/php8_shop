<?php

namespace app\models;

use RedBeanPHP\R;

class Page extends AppModel
{
    public function getPage(string $slug, array $lang): array
    {
        return R::getRow(
            "SELECT p.*, pd.* FROM page p
                JOIN page_description pd on p.id = pd.page_id
                WHERE p.slug = ? AND pd.language_id = ?",
            [$slug, $lang['id']]
        );
    }
}
