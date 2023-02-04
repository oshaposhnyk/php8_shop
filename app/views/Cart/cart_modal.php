<div class="modal-body">
    <?php if (empty($_SESSION['cart']) === false) : ?>
    <div class="table-responsive cart-table">
        <table class="table text-start">
            <thead>
            <tr>
                <th scope="col">Фото</th>
                <th scope="col">Товар</th>
                <th scope="col">Кол-во</th>
                <th scope="col">Цена</th>
                <th scope="col"><i class="far fa-trash-alt"></i></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($_SESSION['cart'] as $id => $item) : ?>
                <tr>
                <td>
                    <a href="product/<?php echo $item['slug']; ?>"><img src="<?php echo PATH.$item['img']; ?>" alt=""></a>
                </td>
                <td><a href="product/<?php echo $item['slug']; ?>"><?php echo $item['title']; ?></a></td>
                <td><?php echo $item['qty']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><a class="del-item" href="cart/delete?id=<?php echo $id; ?>" data-id="<?php echo $id; ?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="4" class="text-end">Итого </td>
                <td class="cart_qty"><?php echo $_SESSION['cart.qty']; ?></td>
            </tr>

            <tr>
                <td colspan="4" class="text-end">Сумма </td>
                <td class="cart_sum"><?php echo $_SESSION['cart.sum']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php else : ?>
        <h4 class="text-start">Empty Cart</h4>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success ripple" data-bs-dismiss="modal">Продолжить покупки</button>
    <?php if (!empty($_SESSION['cart'])) : ?>
        <button type="button" class="btn btn-primary">Оформить заказ</button>
        <button id="clear-cart" type="button" class="btn btn-danger">Очистить корзину</button>
    <?php endif; ?>
</div>