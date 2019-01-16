<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 30.05.2018
 * Time: 16:38
 */
class validations
{
    function emailvalidation($login)
    {

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {

            $valid_email = true;

        }

    }
}

?>