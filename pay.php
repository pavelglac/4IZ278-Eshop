<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 31.05.2018
 * Time: 21:35
 */

session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'controllers/db_carts.php';
$obj = new DB_carts();


$obj->cart_pay($_SESSION['user_id']);

header('Location: index.php');
exit();

?>