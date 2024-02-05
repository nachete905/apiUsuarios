<?php
require_once("BBDDD.php");
require_once("../CONTROL/Usuario.php");

class Modelo extends BBDD{
    public function __construct() {
        parent::__construct();  
    }

    public static function consultarUsuarios(){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario";
        $sql = $conexion->prepare($sql);

        if($sql->execute()){
            $result = $sql->get_result()->fetch_assoc();

            if($result !== false){
                return $result;
            }
        }
        return null;
        
    }

    public static function consultarUsuariosID($id){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE id = ?";
        $sql = $conexion->prepare($sql);
        $sql->bind_param("i", $id);
    
        if($sql->execute()){
            $result = $sql->get_result()->fetch_assoc();
                
            if($result !== false){
                return $result;
            }
        }
            return null;
    }

    public static function consultarUsuariosNombre($nombre){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE nombre = $nombre";

        if($nombre != null){
            $sql = $conexion->prepare($sql);
            $sql->bind_param(":nombre", $nombre);

             if($sql->execute()){
                $result = $sql->get_result()->fetch_assoc();
            }

            if($result !== false){
                return $result;
            }
        
        }
        
        return null;
    }

    public static function insertarUsuario($nombre, $apellido1, $apellido2, $correo, $password, $dni=null, $pais=null, $genero=null, $fecha_nacimiento=null,$direccion=null, $notificaciones = null, $id = null){

        $conexion = BBDD::conectar();
        $sql = "INSERT INTO usuario (correo, password, nombre, apellido1, apellido2, dni, pais, genero, fecha_nacimiento, direccion, notificaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssssssss", $correo, $password, $nombre, $apellido1, $apellido2, $dni, $pais, $genero, $fecha_nacimiento, $direccion, $notificaciones);
        $result = $stmt->execute();
        
        if($result){
            return'{"insercion":"correcta"}';
        }else{
            return'{"insercion":"incorrecta"}';
        }
        
    }
}