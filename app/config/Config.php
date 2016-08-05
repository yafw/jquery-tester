<?php

namespace Config;

class Config
{
    public static $directory;
}

// Initializing root directory
Config::$directory = dirname(__DIR__, 2);

?>
