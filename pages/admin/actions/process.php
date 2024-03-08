<?php
$manager = new Manager($connexion);
if(!empty($_GET['delete_to'])){
    if($manager->deleteTourOperator($_GET['delete_to']))
        header("location:/?s=admin#tableTourOperators");
    else
        echo "Error, unable to delete tour operator";
}
elseif(!empty($_GET['delete_author'])){
    if($manager->deleteAuthor($_GET['delete_author']))
        header("location:/?s=admin&vue=author#tableAuthor");
    else
        echo "Error, unable to delete tour operator";
}
elseif(!empty($_GET['delete_review'])){
    if($manager->deleteReview($_GET['delete_review']))
        header("location:/?s=admin&vue=author#manageReviews");
    else
        echo "Error, unable to delete tour operator";
}
elseif($_GET['process'] == "addOperator"){
    if(!empty($_GET['name']) && !empty($_GET['pw']) && !empty($_GET['link'])){
        if($manager->createOperator(["name" => $_GET['name'], "password" => $_GET['pw'], "link" =>  $_GET['link']]))
            header("location:/?s=admin#tableTourOperators");
        else
            echo "Error, unable to add tour operator";
    }
    else
        echo "Error, name, password and link required, cannot be empty.";
}