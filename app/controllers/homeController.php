<?php

class homeController {
    function __construct()
        {
         
        }    

    function index(){
        echo '<br>'.CONTROLLER.'<br>';
        echo METHOD;

        $data =
        [
            'title' => 'Bee Framework',
        ];

       
        View::render('bee', $data);

    }
}