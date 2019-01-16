<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 31.05.2018
 * Time: 15:21
 */
require_once 'db.php';
class DB_products
extends DB
{

    function products_all() {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT * FROM products ORDER BY id DESC ");
        $stmt->execute();
        return $stmt->fetchAll();


    }

    function product_exist($id) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT count(id) FROM products WHERE id=?");
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
?>