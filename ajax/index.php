<?php
session_start();
ob_start();

if(!empty($_GET['script'])){
    $script = "requests/".$_GET['script'].".php";
    if(file_exists($script)){
        require "../php_config/db.php";
        require "../php_config/autoload.php";
        require "../php_config/const.php";
        require "../php_config/fct.php";

        require $script;
    }
}
ob_end_flush();