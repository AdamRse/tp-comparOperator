<?php
$manager = new Manager($connexion);
if(!empty($_GET['id_destination'])){
    echo json_encode($manager->getOperatorByDestination($_GET['id_destination']));
}
else
    echo json_encode($manager->getAllDestination());