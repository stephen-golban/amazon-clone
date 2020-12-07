<?php
require_once '../../core/init.php';

if (isset($_POST['user-delete'])) {
    $uid = $_POST['u_id'];
    $del = DB::getInstance()->delete('users', array('id', '=', $uid));
    if ($del) {
        Session::flash('success-u', 'Changes have been successfully saved!');
        Redirect::to('../uTable.php');
    } else {
        Session::flash('f-deleted-u', 'User could not be deleted!');
        Redirect::to('../uTable.php');
    }
}
if (isset($_POST['category-delete'])) {
    $cid = $_POST['c_id'];
    $delete = DB::getInstance()->delete('categories', array('id', '=', $cid));
    if ($delete) {
        Session::flash('success-c', 'Changes have been successfully saved!');
        Redirect::to('../cTable.php');
    } else {
        Session::flash('f-deleted-c', 'Category could not be deleted!');
        Redirect::to('../cTable.php');
    }
}
if (isset($_POST['product-delete'])) {
    $pid = $_POST['p_id'];
    $delete = DB::getInstance()->delete('products', array('id', '=', $pid));
    if ($delete) {
        Session::flash('success-p', 'Changes have been successfully saved!');
        Redirect::to('../pTable.php');
    } else {
        Session::flash('f-deleted-p', 'Category could not be deleted!');
        Redirect::to('../pTable.php');
    }
}
