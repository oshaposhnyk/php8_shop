<?php
/**
 * @var $this View
 */
/**
 * @var $page array
 */

use core\Pagination;
use core\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?=baseUrl()?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= $page['title'] ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 page-content">
            <h3 class="section-title"><?= $page['title'] ?></h3>
            <?= $page['content'] ?>

        </div>

    </div>
</div>