<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 31.05.2018
 * Time: 21:12
 */
    session_start();


    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require_once 'controllers/db_carts.php';
    $obj = new DB_carts();

    if (!$obj->cart_item_exist($_GET['id'])){

        header('Location: index.php');
        exit();

    }

    $obj->cart_item_delete($_GET['id']);

    header('Location: cart.php');
    exit();

?>