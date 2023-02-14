<?php
/**
 * @var $products array
 */
/**
 * @var $this View
 */
use core\Pagination;
use core\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 wishlist-content">
            <h3 class="section-title">Wishlist</h3>

            <div class="row">
                <?php if (empty($products) === false) : ?>
                    <?php $this->getPart('parts/products_loop', ['products' => $products]); ?>
                <?php else : ?>
                    <p>Empty wishlist</p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>