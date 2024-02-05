<?php

error_reporting(E_ALL);
require_once("modelo/BBDDD.php");
require_once("modelo/Modelo.php");
require_once("control/Usuario.php");
require_once("control/ControlUsuarios.php");

$ruta = $_SERVER['REQUEST_URI'];

if (strpos($ruta, '/ApiEjemplo/usuarios') === 0) {
    $metodo = $_SERVER['REQUEST_METHOD'];
    switch ($metodo) {
    case 'GET':
        
       if (preg_match( '/^\/ApiEjemplo\/usuarios\/\d+$/',$ruta))
       {
           $id = substr($ruta,strrpos($ruta, "/")+1);
          echo ControlUsuarios::obtenerUsuarios($id);
       }
       else
        echo ControlUsuarios::obtenerUsuarios();
        
        break;
    }
}

