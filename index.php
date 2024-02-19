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
    if ($metodo == 'POST') {
        $patron = '/^\/apiUsuarios\/insert/';
        if (preg_match($patron, $ruta)) {
            if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['correo']) && isset($_POST['password']) || isset($_POST['dni']) || isset($_POST['pais']) ||isset($_POST['genero']) || isset($_POST['fecha_nacimiento']) || isset($_POST['direccion']) ||isset($_POST['notificaciones'])) {
                $nombre = $_POST['nombre'];
                $apellido1 = $_POST['apellido1'];
                $apellido2 = $_POST['apellido2'];
                $correo = $_POST['correo'];
                $password = $_POST['password'];
                $dni = $_POST['dni'];
                $pais = $_POST['pais'];
                $genero = $_POST['genero'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                $direccion = $_POST['direccion'];
                $notificaciones = $_POST['notificaciones'];

                $result = ControlUsuarios::altaCliente($nombre, $apellido1, $apellido2, $correo, $password, $dni, $pais, $genero, $fecha_nacimiento, $direccion, $notificacione);


                if ($result == -1) {
                    echo json_encode($respuesta->error_210());
                } else {

                    echo $result;
                }
            } else {
                echo json_encode($respuesta->error_400());
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
        $patron = '/^\/apiUsuarios\/login/';
        if (preg_match($patron, $ruta)) {
            $correo = $_POST['correo'];
            $pswd = $_POST['pswd'];

            $result = ControlUsuarios::inicioSesion($correo, $pswd);
            if ($result == 1) {
                session_start(); 
                $_SESSION['admin'] = $correo;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (1*60);
                echo "Sesión iniciada";
                if (isset($_SESSION['start']) && time() > $_SESSION['expire']) {
                    session_destroy(); 
                    header("Tu sesión ha expirado"); 
                }
                
            }
           elseif($result == 2){
                echo "no eres admin";
            }
             elseif ($result == -1) {
                echo json_encode($respuesta->error_210());
            } else {
                echo $result;
            }
        }
    } else {
        echo json_encode($respuesta->error_405());
    }
}


if (strpos($ruta, '/apiUsuarios/actualizarNombre') === 0) {
    if ($metodo == 'POST') {
        $patron =  '/^\/apiUsuarios\/actualizarNombre/';
        if (preg_match($patron, $ruta)) {
            if (isset($_POST['nombre']) && isset($_POST['id'])) {
                $nombre = $_POST['nombre'];
                $id = $_POST['id'];
                $result = ControlUsuarios::actualizarNombre($nombre, $id);

                if ($result == -1) {
                    echo json_encode($respuesta->error_210());
                } else {
                    echo $result;
                }
            } else {
                echo json_encode($respuesta->error_400()); // Puedes definir error_400 como un error de "Bad Request"
            }
        }
    } else {
        echo json_encode($respuesta->error_405());
    }
}

if (strpos($ruta, '/apiUsuarios/actualizarCorreo') === 0) {
    if ($metodo == 'POST') {
        $patron =  '/^\/apiUsuarios\/actualizarCorreo/';
        if (preg_match($patron, $ruta)) {
            if (isset($_POST['correo']) && isset($_POST['id'])) {
                $correo = $_POST['correo'];
                $id = $_POST['id'];
                $result = ControlUsuarios::actualizarCorreo($correo, $id);

                if ($result == -1) {
                    echo json_encode($respuesta->error_210());
                } else {
                    echo $result;
                }
            } else {
                echo json_encode($respuesta->error_400()); // Puedes definir error_400 como un error de "Bad Request"
            }
        }
    } else {
        echo json_encode($respuesta->error_405());
    }
}
