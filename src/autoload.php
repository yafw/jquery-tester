<?php

use Config\Config;

spl_autoload_register(function($namespace) {
    $class_path = namespace_to_path($namespace);
    try_require_class($class_path);
});

function namespace_to_path($namespace)
{
    /*
     *    AppBundle  \  Command  \  CheckCommand
     *       [0]                        end()
     */
    $namespace = explode('\\', $namespace);

    $directory = Config::$directory . "/src/" . $namespace[0];
    $class_name = end($namespace) . ".php";

    $class_path = $directory . "/" . $class_name;

    return $class_path;
}

function try_require_class($class_path)
{
    if(file_exists($class_path))
        require_once($class_path);
}

?>
