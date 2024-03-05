<?php

if(isset($_GET['dc'])){
    session_destroy();
    header("location:./");
}
// else if(empty($_SESSION['user']) && !empty($_POST['idZoo'])){
//     $ZooManager = new \Managers\ZooManager($connexion);
//     if($zooConnect = $ZooManager->getZooId($_POST['idZoo'])){
//         $_SESSION['zoo']['id'] = $zooConnect->getId();
//         header("location:./");
//     }
// }