<?php

error_reporting(E_ALL);
require_once("modelo/BBDDD.php");
require_once("modelo/Modelo.php");
require_once("control/Usuario.php");
require_once("control/ControlUsuarios.php");
require_once("control/Response.php");

header('Content-Type: application/json; charset=utf-8');
$ruta = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];
$respuesta = new Response();

if (strpos($ruta, '/apiUsuarios/id') === 0) {
    if ($metodo == 'GET') {
        $patron = '/^\/apiUsuarios\/id\/(\d+)$/';
        if (preg_match($patron, $ruta, $parametros)) {
            $id = $parametros[1];
            $result = ControlUsuarios::obtenerUsuarios($id);
            echo $result;

            if ($result == -1) {
                $respuesta->error_210();
                $respuesta->JsonSalida();
            }
        } else{
            echo ControlUsuarios::obtenerUsuarios();
        }
            
    }else{
        $respuesta->error_405();
        $respuesta->JsonSalida();
    }
}

if(strpos($ruta, '/apiUsuarios/insert') === 0){
    if ($metodo == 'POST') {

        $patron = '/^\/apiUsuarios\/insert\/(\w+)\/(\w+)\/(\w+)\/(\w+)\/(\w+)\/(\w+)\/(\w+)\/(\w+)\/(\d+)\/(\w+)\/(\w+)\/$/';
        
        if (preg_match($patron, $ruta, $parametros)) {
           
            $nombre = $parametros[1];
            $apellido1 = $parametros[2];
            $apellido2 = $parametros[3];
            $correo = $parametros[4];
            $password = $parametros[5];
            $dni = $parametros[6];
            $pais = $parametros[7];
            $genero = $parametros[8];
            $fecha_nacimiento = $parametros[9];
            $direccion = $parametros[10];
            $notificaciones = $parametros[11];

            $result = ControlUsuarios::altaCliente($nombre, $apellido1, $apellido2, $correo, $password, $dni, $pais, $genero, $fecha_nacimiento, $direccion, $notificaciones, $id = null);

            if($result == -1){
                
                $respuesta->error_210();
                $respuesta->JsonSalida();
            } else {
               
                echo $result;
            }
           
        } else {
           
            echo "La ruta no coincide con el patrón esperado.";
        }    
    } else {
      
        echo "El método HTTP no es POST.";
    }
}


if(strpos($ruta, '/apiUsuarios/delete') === 0){
    if ($metodo == 'DELETE') {
        if (preg_match('/^\/apiUsuarios\/delete\/\d+$/', $ruta, $parametros)) {
            $id = $parametros[1];
            $result = ControlUsuarios::elimiarUsuario($id);
            if($result == -1){
                $respuesta->error_210();
                $respuesta->JsonSalida();
            }else{
                echo $result;
            }
           
        }else{
            $respuesta->error_405();
            $respuesta->JsonSalida();
        }           
    }

}


