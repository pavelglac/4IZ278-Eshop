<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 30.05.2018
 * Time: 23:29
 */

session_start();

session_destroy();

header('Location: index.php');

?>