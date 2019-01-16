<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 31.05.2018
 * Time: 17:24
 */
require_once 'db.php';
class db_carts
extends DB
{
    function cart_insert($user_id, $product_id) {

        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO carts(user_id, product_id) VALUES (?, ?)");
        $stmt->execute(array($user_id, $product_id));

    }

    function cart_number($user_id) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT count(id) FROM carts WHERE user_id=?");
        $stmt->execute(array($user_id));
        $number = $stmt->fetchColumn();

        return $number;

    }

    function cart($user_id) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT name, icon, description, carts.id as item FROM carts left join products on carts.product_id=products.id WHERE user_id=?");
        $stmt->execute(array($user_id));
        return $stmt->fetchAll();

    }

    function cart_item_delete($user_id) {

        $db = $this->connect();
        $stmt = $db->prepare("DELETE FROM carts WHERE id=?");
        $stmt->execute(array($user_id));

    }

    function cart_pay($user) {

        $db = $this->connect();
        $stmt = $db->prepare("DELETE FROM carts WHERE user_id=?");
        $stmt->execute(array($user));

    }


    function cart_item_exist($id) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT count(id) FROM carts WHERE id=?");
        $stmt->execute(array($id));
        $number = $stmt->fetchColumn();

        if ($number > 0){

            return true;

        }
        else{

            return false;

        }


    }
}