<?php

class ControlUsuarios{
    public static function obtenerUsuarios($id = null){
        if($id == null){
            return json_encode(Modelo::consultarUsuarios());
        }else{
            return json_encode(Modelo::consultarUsuariosID($id));
        }
        
    }
    public static function obtenerUsuariosNombre($nombre = null){
        if($nombre == null){
            return json_encode(Modelo::consultarUsuarios());

        }else{
            return json_encode(Modelo::consultarUsuariosNombre($nombre));
        }
        
    }

    public static function interstarCliente(){
        if(isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['dni']) && isset($_POST['pais']) && isset($_POST['genero']) && isset($_POST['fecha_nacimiento']) && isset($_POST['direccion']) && isset($_POST['notificaciones'])){
            Modelo::insertarUsuario($_POST['correo'], $_POST['password'], $_POST['name'], $_POST['apellido1'], $_POST['apellido2'], $_POST['dni'], $_POST['pais'], $_POST['genero'], $_POST['fecha_nacimiento'], $_POST['direccion'], $_POST['notificaciones']);
        }
        
    }
}