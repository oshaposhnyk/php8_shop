<?php

namespace app\controllers;

use app\models\Wishlist;
use core\App;

/**
 * @property Wishlist $model
 */
class WishlistController extends AppController
{


    public function indexAction()
    {
        $lang     = App::$app->getProperty('language');
        $products = $this->model->getWishlistProducts($lang);
        $this->setMeta('Wishlist');
        $this->set(['products' => $products]);

    }//end indexAction()


    public function addAction()
    {
        $id = get('id');
        if (!$id) {
            $answer = [
                'result' => 'error',
                'text'   => 'Add error',
            ];
            exit(json_encode($answer));
        }

        $product = $this->model->getProduct($id);

        if ($product) {
            $this->model->addToWishlist($id);
            $answer = [
                'result' => 'success',
                'text'   => 'Add product success',
            ];
        } else {
            $answer = [
                'result' => 'error',
                'text'   => 'Add error',
            ];
        }

        exit(json_encode($answer));

    }//end addAction()

    public function deleteAction()
    {
        $id = get('id');

        if ($this->model->deleteFromWishlist($id)) {
            $answer = [
                'result' => 'success',
                'text'   => 'Delete product success',
            ];
        } else {
            $answer = [
                'result' => 'error',
                'text'   => 'Delete error',
            ];
        }

        exit(json_encode($answer));

    }


}//end class
