<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 31.05.2018
 * Time: 15:58
 */
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'controllers/db_products.php';
$obj = new DB_products();

if (!$obj->product_exist($_GET['id'])){

    header('Location: index.php');
    exit();

}
require_once 'controllers/db_carts.php';

$itm = new db_carts();
$itm->cart_insert($_SESSION['user_id'], $_GET['id']);

header('Location: index.php');
exit();

?>