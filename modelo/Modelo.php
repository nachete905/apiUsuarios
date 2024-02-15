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

    public static function insertarUsuario($nombre, $apellido1, $apellido2, $correo, $password, $dni = null, $pais = null, $genero = null, $fecha_nacimiento = null, $direccion = null, $notificaciones = null, $id = null)
    {

        $conexion = BBDD::conectar();
        $sql = $conexion->prepare("INSERT INTO usuario (correo, password, nombre, apellido1, apellido2, dni, pais, genero, fecha_nacimiento, direccion, notificaciones)
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

    public static function actualizarNombre($nuevoNombre,$id){

        $conexion = BBDD::conectar();
        if($nuevoNombre != null && $id != null ){
            $sql = $conexion->prepare("UPDATE usuario SET nombre = ? WHERE id = ?");
            $sql->bindParam(1, $nuevoNombre, PDO::PARAM_STR);
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
    
    public static function actualizarCorreo($nuevoCorreo,$id){

        $conexion = BBDD::conectar();
        if($nuevoCorreo != null && $id != null ){
            $sql = $conexion->prepare("UPDATE usuario SET correo = ? WHERE id = ?");
            $sql->bindParam(1, $nuevoCorreo, PDO::PARAM_STR);
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


    public static function login($nombre, $password) {
        $conexion = BBDD::conectar();
        if ($nombre != "undefined" && $password != "undefined") {
            //preparar sentencia para comprobar si el usuario existe
            $result = $conexion->prepare("SELECT id FROM alumnos WHERE nombre=? AND password=?");
            $result->bindParam(1, $nombre, PDO::PARAM_STR);
            $result->bindParam(2, $password, PDO::PARAM_STR);
            $result->execute();
            // obtenemos el resultado
            $re = $result->fetch(PDO::FETCH_ASSOC);
            // comprobamos el resultado
            if ($re !== false) {
                $id = $re['id'];
                // comprobamos si es admin
                $res = $conexion->prepare("SELECT tipo FROM tipousuario WHERE id = ?");
                $res->bindParam(1, $id, PDO::PARAM_INT);
                $res->execute();
                // obtenemos el resultado
                $comprobar = $res->fetchAll(PDO::FETCH_ASSOC);
                if ($comprobar !== false) {
                    return $comprobar;
                } else {
                    return "No es admin";
                }
            } else {
                return "incorrecto";
            }
        } else {
            return -1;
        }
    }
}    
