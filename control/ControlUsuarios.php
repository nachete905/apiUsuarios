<?php

class ControlUsuarios{
    public static function obtenerUsuarios($id = null){
        if($id == null){
            return json_encode(Modelo::consultarUsuarios());
        }else{
            $resultado = json_encode(Modelo::consultarUsuariosID($id));
            return $resultado;
            var_dump($resultado);
        }
        
    }
    public static function obtenerUsuariosNombre($nombre = null){
        if($nombre == null){
            return json_encode(Modelo::consultarUsuarios());

        }else{
            return json_encode(Modelo::consultarUsuariosNombre($nombre));
        }
        
    }
    public static function altaCliente(){
         if(isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['email']) && isset($_POST['password'])){
            Modelo::insertarUsuario($_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['email'], $_POST['password']);
         }
    }
    public static function elimiarUsuario($id){
        $result = Modelo::borrarUsuario($id);
        if($result == -1){
            return -1;
        }else{
            return json_encode($result);
        }
        
    }
}