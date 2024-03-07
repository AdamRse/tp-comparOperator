<?php
if(TO){
    if(isset($_GET['process'])){
        require "actions/process.php";
    }
    else{
        require "actions/crud.php";
    }
}
else
    require "actions/notAdmin.php";