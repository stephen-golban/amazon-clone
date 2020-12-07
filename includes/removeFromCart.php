<?php
require_once '../core/init.php';
$user = new User();
if (isset($_POST['remove-from-cart'])) {
    $cid = $_POST['c_i_d'];
    $cartID = $_POST['cid'];
    DB::getInstance()->delete('cart', array('cart_id', '=', $cartID));
    Session::flash('action-success', 'Item was successfully removed from the cart!');
    Redirect::to('../Components/Cart/index.php');
}
