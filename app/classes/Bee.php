<?php 

class Bee {

    // Propiedades del framework
    private $framework = 'Bee Framework';
    private $version = '1.0.0';
    private $uri = [];

    // La funcion principal que se ejecuta al instanciar nuestra clase
    function __construct()
    {
        // echo 'Ejecutando el constructor';
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
        $this->dispatch();
    }


    /**
     * Metodo para iniciar la sesion en el sistema
     * 
     * @return void
     */
    private function init_session(){
        if(session_status() == PHP_SESSION_NONE){
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
        require_once CONTROLLERS.DEFAULT_CONTROLLER.'Controller.php';
        require_once CONTROLLERS.DEFAULT_ERROR_CONTROLLER.'Controller.php';
        

        return;
    }

    /**
     *  Metodo para filtrar y descomponer los elementos de nuestra url y uri
     * 
     * @return void
     */
    private function filter_url(){
        if(isset($_GET['uri'])){
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri, '/'); //Que no vea los "/"
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL); //Limpiar la url
            $this->uri = explode('/', strtolower($this->uri)); //Explora hasta que vea "/" y coloca las letras en minuscula
            return $this->uri;
        }
    }

    /**
     * Metodo para ejecutar y cargar de forma automatica el controlador solicitado por el usuario
     * su metodo y pasar parametro a el
     * 
     * @return void
     */
    private function dispatch(){  //Se ejecuta TODO
        
        // Filtrar la URL y separar la URI
        $this->filter_url();


        //////////////////////////////////////////////////////////////////////////////////
        // Necesitamos saber si se esta pasando el nombre de un controlador en nuestra URI
        // $this->uri[0] es el controlador en cuestion

        if(isset($this->uri[0])){
            $current_controller = $this->uri[0]; //Usuarios Controller.php
            unset($this->uri[0]);
           
        }else{
            $current_controller = DEFAULT_CONTROLLER; //home Controller.php
        }

        
        // Ejecucion del controlador
        // Verificamos si existe una clase con el controlador solicitado 
        $controller = $current_controller.'Controller'; //homeController
        
        if(!class_exists($controller)){
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller'; //errorController
        }

        //////////////////////////////////////////////////////////////////////////////////
        // Ejecucion del metodo solicitado
        if(isset($this->uri[1])){
            $method  = str_replace('-', '_', $this->uri[1]); //Si encuentra un "-" que lo cambie por un "_"

            // Existe o no el metodo dentro de la clase a ejecutar (controllador)
            if(!method_exists($controller, $method)){
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller'; //HomeController
                $current_method = DEFAULT_METHOD; //index
                echo "No existe el metodo ".$method;
            }else{
                $current_method = $method;       
                echo "Si existe el metodo ".$current_method;
            }
            unset($this->uri[1]);
            
        }else{
            $current_method = DEFAULT_METHOD; //index
        }

        //////////////////////////////////////////////////////////////////////////////////
        // Creando constantes para utilizar mas adelante
        define('CONTROLLER', $current_controller);
        define('METHOD'   , $current_method);



        //////////////////////////////////////////////////////////////////////////////////
        //Ejecutando controlador y metodo segun se haga la peticion
        $controller = new $controller;

        // Obteniendo los parametros del URI
        $params = array_values(empty($this->uri) ? [] : $this->uri); //Si no esta vacio que lo haga

        // Llamada al metodo que solicita el usuario en curso
        if(empty($params)){ //Si no hay parametro(vacio)
            call_user_func([$controller, $current_method]);
        }else{
            call_user_func_array([$controller, $current_method], $params);
        }

        return; //Linea final y todo sucede entre esta linea y el comienzo

        // print_r($this->uri);
        // echo '<br>';
        // print_r($params);
        // echo $current_method;
    }

    /**
     * Correr nuestro framework
     * 
     * @return void
     */
    public static function fly(){
        $Bee = new self();
    }
}