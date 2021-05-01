<?php

class Persona {
    // private = no pueden ser utilizada en ningun otro lado mas que dentro de la clase duena
    // protected = puede ser utilizada por la clase duena e hijas, pero no por fuera
    // public = puede ser utilizada por fuera de la clase, dentro de la clase duena e hijas

    private $posible_generos = ['m', 'f'];
    private $posibles_nombres_m = ['Anotinio', 'Jose', 'Juan', 'Manuel', 'Pedro', 'Jesus', 'Miguel', 'Javier', 'David'];
    private $posibles_nombres_f = ['Maria', 'Josefa', 'Isabel', 'Francisca' ,'Lucerito', 'Dolores', 'Ana', 'Martha', 'Karla', 'Pilar'];
    private $posibles_apellidos = ['Garica', 'Martinez', 'Gomez', 'Loaiza', 'Orozco', 'aviles', 'Diaz', 'Serrano', 'Ortega', 'Munoz', 'Romero', 'Castillo'];

    public $persona;
    public $nombres;
    public $apellidos;
    public $genero;

    public function __construct($nombre = null)
    {
        echo 'Soy El constructor de Persona....<br>';
        if($nombre !== null){
            echo sprintf('Pasando el nombre %s dentro del constructor de nuestra clase...<br>', $nombre);
        }
    }

    // Metodo para crear a uno persona de forma aleatoria
    public function crear_persona(){
        $this->genero    = $this->posible_generos[rand(0, 1)];
        $this->nombres   = $this->obtener_nombre();
        $this->apellidos = $this->obtener_apellido().' '.$this->obtener_apellido();
        $this->persona   = $this->nombres.' '.$this->apellidos;
        return $this->persona;
    }

    // Metodo para seleccionar un nombre del array
    private function obtener_nombre(){
        if($this->genero === 'm'){
            return $this->posibles_nombres_m[rand(0, count($this->posibles_nombres_m) - 1)];
        }
        return $this->posibles_nombres_f[rand(0, count($this->posibles_nombres_f) - 1)];
    }

    // Metodo para seleccionar un apellido del array
    private function obtener_apellido(){
        return $this->posibles_apellidos[rand(0, count($this->posibles_apellidos) - 1)];
    }

    // Metodos estaticos para crar una persona
    public static function crear(){
        $persona = new self();
        return $persona->crear_persona();
    }
}

?>