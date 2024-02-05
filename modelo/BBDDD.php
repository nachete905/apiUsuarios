<?php

class BBDD {
    private  static $hostname;
    private  static $usuario;
    private  static $password;
    private  static $basededatos;
    public  function __construct($hostname="localhost", $usuario="prueba", $password="prueba", $basededatos="ApiRest") {
        self::$hostname = $hostname;
        self::$usuario = $usuario;
        self::$password = $password;
        self::$basededatos = $basededatos;
    }

    public static function conectar()
    {
        return new mysqli("localhost", "nacho1","nacho1","landinghfs");
    }
}

