<?php 

class Bee {

    // Propiedades del framework
    private $framework = 'Bee Framework';
    private $version = '1.0.0';
    private $uri = [];

    // La funcion principal que se ejecuta al instanciar nuestra clase
    function __construct()
    {
        echo 'Ejecutando el constructor';
        $this->init();
    }

    /**
     * Metodo para ejecutar cada 'Metodo' de forma subsecuente
     * 
     * @return void
     */
    private function init(){
        // Todos los metodos que queremos ejecutar consecutivamente
        $this->init_session();
        $this->init_load_config();
        $this->init_load_function();
        $this->init_autoload();
    }


    /**
     * Metodo para iniciar la sesion en el sistema
     * 
     * @return void
     */
    private function init_session(){
        if(!session_start()){
            session_start();
        }
        return;
    }
    

    /**
     * Metodo parar cargar la configuracion del sistema
     * 
     * @return void
     */
    private function init_load_config(){
        $file = 'bee_config.php';
        if(!is_file('app/config/'.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', $file, $this->framework));                        
        }

        // Cargando el archivo de configuracion
        require_once 'app/config/'.$file;

        return;
    }


    /**
     * Metodo para cargar todas las funciones del sistema y del usuario
     * 
     * @return void
     */
    private function init_load_function(){
        $file = 'bee_core_functions.php';
        // if(!is_file('app/functions/'.$file)){
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', $file, $this->framework));                        
        }

        // Cargando el archivo de funciones cores
        require_once 'app/functions/'.$file;


        $file = 'bee_custom_functions.php';
        if(!is_file(FUNCTIONS.$file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que %s funcione.', $file, $this->framework));                        
        }

        // Cargando el archivo de funciones custom
        require_once FUNCTIONS.$file;

        return;
    }

    /**
     * Metodo para cargar todos los archivos de forma automatica
     * 
     * @return void
     */
    private function init_autoload(){
        require_once CLASSES.'Db.php';
        require_once CLASSES.'Model.php';
        require_once CLASSES.'Controller.php';

        return;
    }

}