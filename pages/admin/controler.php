<?php
if(ADMIN){
    if(isset($_GET['process'])){
        require "actions/process.php";
    }
    else{
        require "actions/menu.php";
        if(empty($_GET['vue']) || $_GET['vue'] == "to")
            require "actions/crudTo.php";
        else
            require "actions/crudAuthor.php";
    }
}
else
    require "actions/notAdmin.php";