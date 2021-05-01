<?php

// Saber si estamos trabajando de forma local o remota
define('IS_LOCAL'   , in_array($_SERVER['REMOTE_ADDR']                                                                 , ['127.0.0.1', '::1']));

// Definir el uso horario o timezone del sistema
date_default_timezone_set('America/Bogota');

// Lenguaje
define('LANG'       , 'es');

// Ruta base de nuestro proyecto
define('BASEPATH'   , IS_LOCAL ? '/framework_bee(php)/proyecto/' : '____EL BASEPATH EN PRODUCCION___');

// Sal del Sistema
define('AUTH_SALT'  , 'BeeFramework<3');

// Puerto y la URL del sitio
define('PORT'       , '8080');
define('URL'        , IS_LOCAL ? 'http://127.0.0.1:'.PORT.'/framework_bee(php)/proyecto/' : '___URL EN PRODUCCION___');

// Las rutas de directorios de archivos
define('DS'         , DIRECTORY_SEPARATOR);
define('ROOT'       , getcwd().DS);

define('APP'        , ROOT.'app'.DS);
define('CLASSES'    , APP.'classes'.DS);
define('CONFIG'     , APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('FUNCTION'   , APP.'functions'.DS);
define('MODELS'     , APP.'models'.DS);

define('TEMPLATES'  , ROOT.'templates'.DS);
define('INCLUDES'   , TEMPLATES.'includes'.DS);
define('MODULES'    , TEMPLATES.'modules'.DS);
define('VIEWS'      , TEMPLATES.'views'.DS);

define('ASSETS'     , URL.'assets/');
define('CSS'        , ASSETS.'css/');
define('FAVICON'    , ASSETS.'favicon/');
define('FONTS'      , ASSETS.'fonts/');
define('IMAGES'     , ASSETS.'images/');
define('JS'         , ASSETS.'js/');
define('PLUGINS'    , ASSETS.'plugins/');
define('UPLOADS'    , ASSETS.'uploads/');

