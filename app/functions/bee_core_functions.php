<!-- Este archivo va a tener las funciones que son estrictamente requeridad para que funcione el framework -->
<?php

// Primera funcion de prueba core
function to_object($array){
    return json_decode(json_encode($array));
}