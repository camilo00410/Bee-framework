<?php

class usersController {
    function __construct()
        {
            echo '<br>Ejecutando: '.__CLASS__;
        }    

    function ver($id = null, $nombre_usuario = null){
        echo '<br> En el metodo Ver';
        echo sprintf('Viendo el perfil del usuario %s con id %s en la clase %s', $nombre_usuario, $id, __CLASS__);
    }
    function actualizar(){
        echo '<br> En el metodo Actualizar';
    }
    function eliminar(){
        echo '<br> En el metodo Eliminar';
    }
    function agregar(){
        echo '<br> En el metodo Agregar';
    }
} 