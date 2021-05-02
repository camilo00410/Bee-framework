<?php

class errorController {
    function __construct()
        {
            echo '<h1>Pagina no encontrada</h1>';
        }    
    function index(){
        echo "Ejecutando ".__CLASS__;
    }
}