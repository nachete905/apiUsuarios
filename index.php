<?php

error_reporting(E_ALL);
require_once("modelo/BBDDD.php");
require_once("modelo/Modelo.php");
require_once("control/Usuario.php");
require_once("control/ControlUsuarios.php");
require_once("control/Response.php");
$respuesta = new Response;


header('Content-Type: application/json; charset=utf-8');
$ruta = $_SERVER['REQUEST_URI'];
$metodo = $_SERVER['REQUEST_METHOD'];

if (strpos($ruta, '/apiUsuarios/id') === 0) {
    if ($metodo == 'GET') {
        $patron = '/^\/apiUsuarios\/id\/(\d+)$/';
        if (preg_match($patron, $ruta, $parametros)) {
            $id = $parametros[1];
            $result = ControlUsuarios::obtenerUsuarios($id);
            echo $result;

            if ($result == -1) {
                echo json_encode($respuesta->error_210());
            }
        } else {
            echo ControlUsuarios::obtenerUsuarios();
        }
    } else {
        json_encode($respuesta->error_405());
    }
}

if (strpos($ruta, '/apiUsuarios/insert') === 0) {
    echo "dfgvedfgver";
    if ($metodo == 'POST') {
        $patron = '/^\/apiUsuarios\/insert/';
        if(preg_match($patron, $ruta)){
            $datos = json_decode(file_get_contents('php://input'));
            $result = ControlUsuarios::altaCliente(
                $datos->nombre,
                $datos->apellido1,
                $datos->apellido2,
                $datos->correo,
                $datos->password,
                isset($datos->dni) ? $datos->dni : null,
                isset($datos->pais) ? $datos->pais : null,
                isset($datos->genero) ? $datos->genero : null,
                isset($datos->fecha_nacimiento) ? $datos->fecha_nacimiento : null,
                isset($datos->direccion) ? $datos->direccion : null,
                isset($datos->notificaciones) ? $datos->notificaciones : null,
                $id = null
            );

    
            if ($result == -1) {
                echo json_encode($respuesta->error_210());
                
            } else {
    
                echo $result;
            }

        }
       
    } else {
        echo json_encode($respuesta->error_405());

    }
}


if (strpos($ruta, '/apiUsuarios/delete') === 0) {
    if ($metodo == 'DELETE') {
        $patron = '/^\/apiUsuarios\/delete\/id\/(\d+)$/';
        if (preg_match($patron, $ruta, $parametros)) {
            $id = $parametros[1];
            $result = ControlUsuarios::elimiarUsuario($id);
            if ($result == -1) {
                echo json_encode($respuesta->error_210());
            } else {
                echo $result;
            }
        } else {
            echo json_encode($respuesta->error_405());
        }
    }
}

if (strpos($ruta, '/apiUsuarios/login') === 0) {
    if ($metodo == 'POST') {
        $patron = '/^\/apiUsuarios\/login\/$/';
        if (preg_match($patron, $ruta)){

            $correo = $_POST['correo'];
            $pswd = $_POST['pswd'];
            $result = ControlUsuarios::login($correo, $pswd);

            if ($result == -1) {
                echo json_encode($respuesta->error_210());
            } else {
                echo $result;
            }
        } 
    }else {
        echo json_encode($respuesta->error_405());
    }
}

if(strpos($ruta, '/apiUsuarios/actualizarNombre') === 0){
    if($metodo == 'PUT'){
        $patron =  '/^\/apiUsuarios\/actualizarNombre/';
        if(preg_match($patron, $ruta)){
            $datos = json_decode(file_get_contents('php://input'));
            $result = ControlUsuarios::actualizarNombre($datos->nuevoNombre,$datos->id);

            if ($result == -1) {
                echo json_encode($respuesta->error_210());
            } else {
    
                echo $result;
            }
        }
    }else {
        echo json_encode($respuesta->error_405());
    }
}

if(strpos($ruta, '/apiUsuarios/actualizarCorreo') === 0){
    if($metodo == 'PUT'){
        $patron =  '/^\/apiUsuarios\/actualizarCorreo/';
        if(preg_match($patron, $ruta)){
            $datos = json_decode(file_get_contents('php://input'));
            $result = ControlUsuarios::actualizarCorreo($datos->nuevoCorreo,$datos->id);

            if ($result == -1) {
                echo json_encode($respuesta->error_210());
            } else {
    
                echo $result;
            }
        }
    }else{
        echo json_encode($respuesta->error_405());
    }

}