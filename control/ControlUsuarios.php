<?php

class ControlUsuarios
{
    public static function obtenerUsuarios($id = null)
    {
        if ($id == null) {
            return json_encode(Modelo::consultarUsuarios());
        } else {
            $resultado = json_encode(Modelo::consultarUsuariosID($id));
            return $resultado;
            var_dump($resultado);
        }
    }
    public static function obtenerUsuariosNombre($nombre = null)
    {
        if ($nombre == null) {
            return json_encode(Modelo::consultarUsuarios());
        } else {
            return json_encode(Modelo::consultarUsuariosNombre($nombre));
        }
    }
    public static function altaCliente($nombre, $apellido1, $apellido2, $correo, $password, $dni = null, $pais = null, $genero = null, $fecha_nacimiento = null, $direccion = null, $notificaciones = null, $id = null)
    {
        $result =  Modelo::insertarUsuario($nombre, $apellido1, $apellido2, $correo, $password, $dni, $pais, $genero, $fecha_nacimiento, $direccion, $notificaciones, $id);
        if ($result === -1) {
            return -1;
        } else {
            return '{"insercion": "correcta"}';
        }
    }
    public static function elimiarUsuario($id)
    {
        $result = Modelo::borrarUsuario($id);
        if ($result == -1) {
            return -1;
        } else {
            return json_encode($result);
        }
    }

    public static function login($nombre, $pswd){
        $result = Modelo::login($nombre, $pswd);
        if ($result == -1) {
            return -1;
            echo "123"; 
        } else {
            return json_encode($result);            echo "1232"; 
        }
    }
}
