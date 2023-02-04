<?php
    /** @var $products array */
    /** @var $breadcrumbs string */
    /** @var $category array */
    /** @var $this View */
    /** @var $pagination Pagination */
    /** @var $total int */

use core\Pagination;
use core\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs ?>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= $category['title'] ?></h3>
            <?php if (!empty($category['content'])): ?>
                <div class=".category-desc">
                    <?= $category['content'] ?>
                </div>
                <hr>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty($products) && count($products) > 1): ?>
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="input-sort">Сортировка:</label>
                            <select class="form-select" id="input-sort">
                                <option disabled>По умолчанию</option>
                                <option value="sort=title_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title_asc') {
    echo 'selected';
}?>>Название (А - Я)</option>
                                <option value="sort=title_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'title_desc') {
    echo 'selected';
}?>>Название (Я - А)</option>
                                <option value="sort=price_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') {
    echo 'selected';
}?>>Цена (низкая &gt; высокая)</option>
                                <option value="sort=price_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') {
    echo 'selected';
}?>>Цена (высокая &gt; низкая)</option>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

<!--                <div class="col-sm-6">-->
<!--                    <div class="input-group mb-3">-->
<!--                        <label class="input-group-text" for="input-sort">Показать:</label>-->
<!--                        <select class="form-select" id="input-sort">-->
<!--                            <option selected="">15</option>-->
<!--                            <option value="1">25</option>-->
<!--                            <option value="2">50</option>-->
<!--                            <option value="3">75</option>-->
<!--                            <option value="3">100</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <div class="row">
                <?php if (!empty($products)): ?>
                    <?php $this->getPart('parts/products_loop', ['products' => $products]); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($products) && $pagination->countPages > 1): ?>
                        <?= $pagination ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>

    </div>
</div>