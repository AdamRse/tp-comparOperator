<?php
$manager = new Manager($connexion);
if(!empty($_GET['delete_to'])){
    if($manager->deleteTourOperator($_GET['delete_to']))
        header("location:/?s=admin#tableTourOperators");
    else
        echo "Error, unable to delete tour operator";
}
if($_GET['process'] == "addOperator"){
    if($manager->createOperator($connexion))
        header("location:/?s=admin#tableTourOperators");
    else
        echo "Error, unable to add tour operator";
}