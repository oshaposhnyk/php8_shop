<?php

namespace app\controllers;

use app\models\Wishlist;

/**
 * @property Wishlist $model
 */
class WishlistController extends AppController
{


    public function addAction()
    {
        $id = get('id');
        if (!$id) {
            $answer = [
                'result' => 'error',
                'test'   => 'Add error',
            ];
            exit(json_encode($answer));
        }

        $product = $this->model->getProduct($id);

        if ($product) {
            $this->model->addToWishlist($id);
            $answer = [
                'result' => 'success',
                'test'   => 'Add product success',
            ];
        } else {
            $answer = [
                'result' => 'error',
                'test'   => 'Add error',
            ];
        }

        exit(json_encode($answer));

    }//end addAction()


}//end class
