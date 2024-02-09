<?php
require_once("BBDDD.php");
require_once("control/Usuario.php");

class Modelo extends BBDD{

    public static function consultarUsuarios(){
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario";
        $sql = $conexion->prepare($sql);

        if($sql->execute()){
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if($result){
                header('HTTP/1.1 200 Cliente seleccionado');
                return $result;
            }
        }else{
            header('HTTP/1.1 404 Error al seleccionar el cliente');
        }
            

        return null;
        
    }

    public static function consultarUsuariosID($id){
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE id = :id";
        if($id != null){
            $sql = $conexion->prepare($sql);
            $sql->bindParam(":id", $id);
            if($sql->execute()){
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if($result){
                    header('HTTP/1.1 200 Cliente seleccionado');
                    return $result;
                }
            }else{
                header('HTTP/1.1 404 Error al seleccionar el cliente');
            }
               
        }else{
            return -1;
        }
   

    }

    public static function consultarUsuariosNombre($nombre){
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE nombre = :nombre";

        if($nombre != null){
            $sql = $conexion->prepare($sql);
            $sql->bindParam(":nombre", $nombre);

            if($sql->execute()){
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if($result){
                    header('HTTP/1.1 200 Cliente seleccionado');
                    return $result;
                }
            }else{
                header('HTTP/1.1 404 Error al seleccionar el cliente');
            }
               
        }else{
            return -1;
        }
        
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

        if($sql->execute()){
            header('HTTP/1.1 200 Cliente creado');
        }else{
            header('HTTP/1.1 404 Error al crear el cliente');
        }
    }

    public static function borrarUsuario($id){

        $conexion = BBDD::conectar();
        $sql = $conexion->prepare("DELETE FROM usuario WHERE id = :id");
        if($id != null){
            $sql->bindParam(":id", $id);
            if($sql->execute()){
                header('HTTP/1.1 200 Cliente borrado');
            }else{
                header('HTTP/1.1 404 Error al borrar el cliente');
            }
        }else{
            return -1;
        }  
    }
}