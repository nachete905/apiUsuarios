<?php
class BBDD {

    public static function conectar(){
      $server="localhost";
      $dbname="landinghfs";
      $user="nacho1";
      $password="nacho1";

       try{
           $connection = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
           $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           return $connection;
       } catch(PDOException $e){
           die("ERROR: ".$e->getMessage());
       }
    }
}
