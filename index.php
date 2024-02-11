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
        } else {
            echo ControlUsuarios::obtenerUsuarios();
        }
    } else {
        $respuesta->error_405();
        $respuesta->JsonSalida();
    }
}

if (strpos($ruta, '/apiUsuarios/insert') === 0) {
    if ($metodo == 'POST') {
        $datos = json_decode(file_get_contents('php://input'));
        $result = ControlUsuarios::altaCliente(
            isset($datos->nombre) ? $datos->nombre : null,
            isset($datos->apellido1) ? $datos->apellido1 : null,
            isset($datos->apellido2) ? $datos->apellido2 : null,
            isset($datos->correo) ? $datos->correo : null,
            isset($datos->password) ? $datos->password : null,
            isset($datos->dni) ? $datos->dni : null,
            isset($datos->pais) ? $datos->pais : null,
            isset($datos->genero) ? $datos->genero : null,
            isset($datos->fecha_nacimiento) ? $datos->fecha_nacimiento : null,
            isset($datos->direccion) ? $datos->direccion : null,
            isset($datos->notificaciones) ? $datos->notificaciones : null,
            $id = null
        );

        if ($result == -1) {

            $respuesta->error_210();
            $respuesta->JsonSalida();
        } else {

            echo $result;
        }
    } else {

        echo "El método HTTP no es POST.";
    }
}


if (strpos($ruta, '/apiUsuarios/delete') === 0) {
    if ($metodo == 'DELETE') {
        if (preg_match('/^\/apiUsuarios\/delete\/\d+$/', $ruta, $parametros)) {
            $id = $parametros[1];
            $result = ControlUsuarios::elimiarUsuario($id);
            if ($result == -1) {
                $respuesta->error_210();
                $respuesta->JsonSalida();
            } else {
                echo $result;
            }
        } else {
            $respuesta->error_405();
            $respuesta->JsonSalida();
        }
    }
}
