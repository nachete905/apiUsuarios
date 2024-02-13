<?php
class BBDD {

    public static function conectar(){
       $datosConec = self::datosConexion();

       try{
           $connection = new PDO("mysql:host=$datosConec[server];dbname=$datosConec[dbname]",$datosConec["user"],$datosConec["password"]);
           $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           return $connection;
       } catch(PDOException $e){
           die("ERROR: ".$e->getMessage());
       }
    }

    
    public static function datosConexion(){
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "/BaseDatos.Json");
        return json_decode($jsondata, true);
    }
}
