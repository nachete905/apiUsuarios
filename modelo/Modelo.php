<?php
require_once("BBDDD.php");
require_once("control/Usuario.php");

class Modelo extends BBDD
{

    public static function consultarUsuarios()
    {
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario";
        $sql = $conexion->prepare($sql);

        if ($sql->execute()) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                header('HTTP/1.1 200 Cliente seleccionado');
                return $result;
            }
        } else {
            header('HTTP/1.1 404 Error al seleccionar el cliente');
        }

        return null;
    }

    public static function consultarUsuariosID($id)
    {
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE id = :id";
        if ($id != null) {
            $sql = $conexion->prepare($sql);
            $sql->bindParam(":id", $id);
            if ($sql->execute()) {
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    header('HTTP/1.1 200 Cliente seleccionado');
                    return $result;
                }
            } else {
                header('HTTP/1.1 404 Error al seleccionar el cliente');
            }
        } else {
            return -1;
        }
    }

    public static function consultarUsuariosNombre($nombre)
    {
        $conexion = BBDD::conectar();
        $sql = "SELECT nombre, apellido1, apellido2, correo FROM usuario WHERE nombre = :nombre";

        if ($nombre != null) {
            $sql = $conexion->prepare($sql);
            $sql->bindParam(":nombre", $nombre);

            if ($sql->execute()) {
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    header('HTTP/1.1 200 Cliente seleccionado');
                    return $result;
                }
            } else {
                header('HTTP/1.1 404 Error al seleccionar el cliente');
            }
        } else {
            return -1;
        }
    }
    public static function insertarUsuarioCompleto($nombre, $apellido1, $apellido2, $correo, $password, $dni = null, $pais = null, $genero = null, $fecha_nacimiento = null, $direccion = null, $notificaciones = null, $id = null)
    {
    
        $conexion = BBDD::conectar();
        $sql = $conexion->prepare("INSERT INTO usuario (correo, password, nombre, apellido1, apellido2, dni, pais, genero, fecha_nacimiento, direccion, notificaciones)
        VALUES (:correo, :password, :nombre, :apellido1, :apellido2,");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":apellido1", $apellido1);
        $sql->bindParam(":apellido2", $apellido2);
        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":password", $password);
        $sql->bindParam(":dni", $dni);
        // $sql->bindParam(":pais", $pais);
        // $sql->bindParam(":genero", $genero);
        // $sql->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        // $sql->bindParam(":direccion", $direccion);
        // $sql->bindParam(":notificaciones", $notificaciones);
    
        if ($sql->execute()) {
            header('HTTP/1.1 200 Cliente creado');
        } else {
            header('HTTP/1.1 404 Error al crear el cliente');
        }
    }


    public static function borrarUsuario($id)
    {

        $conexion = BBDD::conectar();
        $sql = $conexion->prepare("DELETE FROM usuario WHERE id = :id");
        if ($id != null) {
            $sql->bindParam(":id", $id);
            if ($sql->execute()) {
                header('HTTP/1.1 200 Cliente borrado');
            } else {
                header('HTTP/1.1 404 Error al borrar el cliente');
            }
        } else {
            return -1;
        }
    }

    public static function actualizarNombre($nombre,$id){

        $conexion = BBDD::conectar();
        if($nombre != null && $id != null ){
            $sql = $conexion->prepare("UPDATE usuario SET nombre = ? WHERE id = ?");
            $sql->bindParam(1, $nombre, PDO::PARAM_STR);
            $sql->bindParam(2, $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                header('HTTP/1.1 200 Nombre actualizado');
            }else{
                header('HTTP/1.1 404 Error al actualizar el nombre');
            }
        }else{
            return -1;
        }
    }
    
    public static function actualizarCorreo($correo,$id){

        $conexion = BBDD::conectar();
        if($correo != null && $id != null ){
            $sql = $conexion->prepare("UPDATE usuario SET correo = ? WHERE id = ?");
            $sql->bindParam(1, $correo, PDO::PARAM_STR);
            $sql->bindParam(2, $id, PDO::PARAM_INT);

            if ($sql->execute()) {
                header('HTTP/1.1 200 Correo actualizado');
            }else{
                header('HTTP/1.1 404 Error al actualizar el correo');
            }
        }else{
            return -1;
        }
    }
    public static function insertarUser($correo, $password, $password2){
        $conexion = BBDD::conectar();
        $sql = $conexion->prepare("INSERT INTO usuario (correo, password) VALUES (:correo, :password)");

        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":password", $password);

        if($password === $password2){
            if($sql->execute()){
                header('HTTP/1.1 200 Cliente creado');
            }else{
                return -1;
            }
        }
            
        


    }

    public static function login($correo, $password) {
        $conexion = BBDD::conectar();
        $sql ="SELECT tipoUsuario FROM usuario WHERE correo=? AND password=?";
    
        if ($correo != "undefined" && $password != "undefined") {
            $sql = $conexion->prepare($sql);
            $sql->bindParam(1, $correo, PDO::PARAM_STR);
            $sql->bindParam(2, $pswd, PDO::PARAM_STR);
            $sql->execute();
    
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                header('HTTP/1.1 200 cliente correcto');
                
            } else {   
                return -2; // Usuario no encontrado
            }
        } else {
            return -1; // Datos de inicio de sesión no válidos
        }
    }


    
    
   
}    
