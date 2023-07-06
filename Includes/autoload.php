<?php
function autoloadClasses($className)
{
    $classFile = __DIR__ . '/Includes/' . $className. '.php';
    if (file_exists($classFile)) {
        include_once $classFile;
    }
}

?>