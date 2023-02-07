<?php

namespace app\models;

use RedBeanPHP\R;

class Wishlist extends AppModel
{


    public function getProduct(int $id): array|null|string
    {
        return R::getCell('SELECT id FROM product WHERE status = 1 AND id = ?', [$id]);

    }//end getProduct()


    public function addToWishlist(int $id)
    {
        $wishlist = self::getWishlistIds();
        if (!$wishlist) {
            setcookie('wishlist', $id, (time() + 3600 * 24 * 7 * 30), '/');
        } else {
            if (!in_array($id, $wishlist)) {
                if (count($wishlist) > 5) {
                    array_shift($wishlist);
                }

                $wishlist[] = $id;
                debug($wishlist, 1);
                $wishlist   = implode(',', $wishlist);
                setcookie('wishlist', $wishlist, (time() + 3600 * 24 * 7 * 30), '/');
            }
        }

    }//end addToWishlist()


    public static function getWishlistIds(): array
    {
        $wishlist = ($_COOKIE['$wishlist'] ?? '');

        if ($wishlist) {
            $wishlist = explode(',', $wishlist);
        }

        if (is_array($wishlist)) {
            $wishlist = array_slice($wishlist, 0, 6);
            $wishlist = array_map('intval', $wishlist);
        } else {
            $wishlist = [];
        }

        return $wishlist;

    }//end getWishlistIds()


}//end class
