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
}