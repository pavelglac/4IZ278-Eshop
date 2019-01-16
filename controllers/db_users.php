<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 30.05.2018
 * Time: 16:29
 */
require_once 'db.php';
class DB_users
extends DB
{

    function user_insert($login, $password) {

        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
        $stmt->execute(array($login, $password));

    }

    function user_id($login) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->execute(array($login));
        return (int)$stmt->fetchColumn();

    }

    function user_data($email) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute(array($email));
        return $stmt->fetchAll()[0];

    }


    function email_exist($email) {

        $db = $this->connect();
        $stmt = $db->prepare("SELECT count(id) FROM users where email like ?;");
        $stmt->execute(array($email));
        $count = $stmt->fetchColumn();

        if ($count > 0){

            return true;
        }
        else{

            return false;

        }

    }
}
?>