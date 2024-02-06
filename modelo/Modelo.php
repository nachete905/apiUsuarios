<?php
require_once("BBDDD.php");
require_once("../CONTROL/Usuario.php");

class Modelo extends BBDD{

    public static function consultarUsuarios(){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario";
        $sql = $conexion->prepare($sql);

        if($sql->execute()){
            //$result = $sql->get_result()->fetch_assoc();

            if($result !== false){
                return $result;
            }
        }
        return null;
        
    }

    public static function consultarUsuariosID($id){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE id = :id";
        $sql = $conexion->prepare($sql);
        $sql->bindParam(":id", $id);
    
        if($sql->execute()){
            //$result = $sql->get_result()->fetch_assoc();
                
            if($result !== false){
                return $result;
            }
        }
            return null;
    }

    public static function consultarUsuariosNombre($nombre){
        $conexion = BBDD::conectar();
        $result = null;
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE nombre = :nombre";

        if($nombre != null){
            $sql = $conexion->prepare($sql);
            $sql->bindParam(":nombre", $nombre);

             if($sql->execute()){
                //$result = $sql->get_result()->fetch_assoc();
            }

            if($result !== false){
                return $result;
            }
        
        }
        
        return null;
    }

    public static function insertarUsuario($nombre, $apellido1, $apellido2, $correo, $password, $dni=null, $pais=null, $genero=null, $fecha_nacimiento=null,$direccion=null, $notificaciones = null, $id = null){

        $conexion = BBDD::conectar();
        $sql = $conexion->prepare( "INSERT INTO usuario (correo, password, nombre, apellido1, apellido2, dni, pais, genero, fecha_nacimiento, direccion, notificaciones)
        VALUES (:correo, :password, :nombre, :apellido1, :apellido2, :dni, :pais, :genero, :fecha_nacimiento, :direccion, :notificaciones)");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":apellido1", $apellido1);
        $sql->bindParam(":apellido2", $apellido2);
        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":password", $password);
        $sql->bindParam(":dni", $dni);
        $sql->bindParam(":pais", $pais);
        $sql->bindParam(":genero", $genero);
        $sql->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        $sql->bindParam(":direccion", $direccion);
        $sql->bindParam(":notificaciones", $notificaciones);

        $sql->execute();
       
        
    }
}