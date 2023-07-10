<?php
spl_autoload_register(function ($className) {
    $classMap = [
        'services' => 'Services/' . $className . '.service.php',
        'dbconnect' => 'Models/' . $className . '.inc.php',
        'Models' => 'Models/' . $className . '.model.php',
    ];
    
    foreach ($classMap as $class => $path) {
        $fullPath = dirname(__DIR__) . '/' . $path;
        
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }
});
?>