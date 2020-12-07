<?php

require_once '../core/init.php';
$user = new User();
if (isset($_POST['add-to-cart'])) {
    $product_ID = $_POST['prodID'];
    $product_price = $_POST['product_price'];
    DB::getInstance()->insert('cart', array(
        'user_id' => $user->data()->id,
        'prod_id' => $product_ID,
        'prod_price' => Input::get('product_price'),
    ));
    Session::flash('action-success', "Product has been successfully added to cart");
    Redirect::to($_SESSION['redirectTo']);
}
