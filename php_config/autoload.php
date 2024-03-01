<?php
function autoloading($class){
    $path = $_SERVER['DOCUMENT_ROOT']."/classes/$class.php";
    require $path;
}
spl_autoload_register("autoloading");