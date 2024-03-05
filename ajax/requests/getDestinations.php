<?php
$manager = new Manager($connexion);
echo json_encode($manager->getAllDestination());
