<?php
function autoloadClasses($className)
{
    $classMap = [
        'services' => 'Services/' . $className . '.service.php',
        'dbconnect' => 'Models/' . $className . '.inc.php',
    ];
    
    foreach ($classMap as $class => $path) {
        $fullPath = dirname(__DIR__) . '/' . $path;
        
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }
}

spl_autoload_register('autoloadClasses');

?>