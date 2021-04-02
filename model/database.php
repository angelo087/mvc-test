<?php
class Database
{
    public static function StartUp()
    {
        //$pdo = new PDO('mysql:host=localhost;dbname=colegio;charset=utf8', 'root', '');
        $pdo = new PDO('mysql://bb8d9ff2c33c4a:0652b1f6@us-cdbr-east-03.cleardb.com/heroku_03e6bac07431ea4?reconnect=true', 'bb8d9ff2c33c4a', '0652b1f6');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}