<?php

class Usuario implements JsonSerializable
{
    private $id;
    private $correo;
    private $password;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $dni;
    private $pais;
    private $genero;
    private $fecha_nachimiento;
    private $direccion;
    private $notificaciones;

    public function __construct( $correo,  $password,  $nombre,  $apellido1,  $apellido2,  $dni = null,  $pais = null,  $genero = null,  $fecha_nachimiento = null,  $direccion = null,  $notificaciones = null, $id = null)
    {
        $this->id = $id;
        $this->correo = $correo;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->dni = $dni;
        $this->pais = $pais;
        $this->genero = $genero;
        $this->fecha_nachimiento = $fecha_nachimiento;
        $this->direccion = $direccion;
        $this->notificaciones = $notificaciones;
    }

    
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'correo' => $this->correo,
            'password' => $this->password,
            'nombre' => $this->nombre,
            'apellido1' => $this->apellido1,
            'apellido2' => $this->apellido2,

        ];
    }
}
