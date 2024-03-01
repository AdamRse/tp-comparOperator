<?php
function autoloading($class){
    $path = $_SERVER['DOCUMENT_ROOT']."/classes/".str_replace('\\', '/', $class).".class.php";
    require $path;
}
spl_autoload_register("autoloading");