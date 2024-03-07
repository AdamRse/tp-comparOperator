<?php
if(ADMIN){
    if(isset($_GET['process'])){
        require "actions/process.php";
    }
    else{
        require "actions/menu.php";
        require "actions/crud.php";
    }
}
else
    require "actions/notAdmin.php";