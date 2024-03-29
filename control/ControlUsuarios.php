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
    public static function altaCliente( $correo, $password, $password2)
    {
        $result =  Modelo::insertarUser($correo, $password, $password2);
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

    public static function actualizarNombre($nombre, $id){
        $result = Modelo::actualizarNombre($nombre, $id);
        if ($result === -1) {
            return -1;
          } else {
            // si la actualizaciòn es correcta devolver correcta sino incorrecta
            if ($result === true) {
              return '{"actualizacion": "correcta"}';
            }
          }
    }

    public static function actualizarCorreo($correo, $id){
        $result = Modelo::actualizarCorreo($correo, $id);
        if ($result === -1) {
            return -1;
          } else {
            // si la actualizaciòn es correcta devolver correcta sino incorrecta
            if ($result === true) {
              return '{"actualizacion": "correcta"}';
            }
          }
    }

    public static function inicioSesion($correo, $pswd) {
        $result = Modelo::login($correo, $pswd);
    
        if ($result == -1) {
            return -1;
        } else {
            return $result; 
        }
    }
}
