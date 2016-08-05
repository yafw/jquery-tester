<?php

$config_path = dirname(__DIR__) . "/app/config/Config.php";
require_once($config_path);

$vendor_autoload_path = Config::$directory . "/vendor/autoload.php";
require_once($vendor_autoload_path);

$src_autoload_path = Config::$directory . "/src/autoload.php";
require_once($src_autoload_path);

?>
