<?php
$manager = new Manager($connexion);
if(!empty($_GET['delete_to'])){
    if($manager->deleteTourOperator($_GET['delete_to']))
        header("location:/?s=admin#tableTourOperators");
    else
        echo "Error, unable to delete tour operator";
}
if($_GET['process'] == "addOperator"){
    if(!empty($_GET['name']) && !empty($_GET['pw']) && !empty($_GET['link'])){
        if($manager->createOperator(["name" => $_GET['name'], "password" => $_GET['pw'], "link" =>  $_GET['link']]))
            header("location:/?s=admin#tableTourOperators");
        else
            echo "Error, unable to add tour operator";
    }
    else
        echo "Error, name, password and link required, cannot be empty.";
}