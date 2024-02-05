<?php
require_once("../modelo/Modelo.php");

$modelo = new Modelo();

$user = $modelo::insertarUsuario("nacho","sanz", "mesa","ignacio@gmail.com","test","11087686f", null, null, null, null, null, null);

echo $user;