<?php
$manager = new Manager($connexion);
if(!empty($_GET['pw'])){
    if($manager->updatePasswordTo(TO, $_GET['pw']))
        header("location:/?s=manage_to&pw_success#manageAccount");
    else
        echo "Error, unable to delete tour operator";
}
