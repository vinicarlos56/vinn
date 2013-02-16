<?php 

define('BASE_PATH', __DIR__);

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('Controller','',lcfirst($class_name));

    $directorys = array(
        'models/',
        'views/',
        'controllers/',
        'lib/'
    );   
    
    foreach($directorys as $directory){        
        if(file_exists($directory.$class_name . '.php')){
            require_once($directory.$class_name . '.php');            
            //return;
        }else{
            //throw new Exception("Unable to load $class_name.");
        }           
    }
});

