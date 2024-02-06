<?php
require_once("../modelo/Modelo.php");
require_once("ControlUsuarios.php");
$control = new ControlUsuarios();
$modelo = new Modelo();

$modelo::insertarUsuario("nacho","sanz", "mesa","ignacio@gmail.com","test",null, null, null, null, null, null, null);

