<?php

class DB
{

    protected function connect()
    {

        return new PDO('mysql:host=localhost;dbname=semestralka;charset=utf8', 'root');

    }

}

?>