<?php
if(isset($_GET['dc'])){//On veut se déconnecter
    session_destroy();
    echo json_encode(true);
}
else if(empty($_SESSION['user'])){//Si on apelle le script et qu'on est pas connecté, on veut se connecter
    if(empty($_GET['name'])){//On vérifie l'intégrité des données
        echo json_encode(["error" => ["code" => 1, "message" => "A name is required"]]);
        exit();
    }
    if(empty($_GET['password'])){
        echo json_encode(["error" => ["code" => 2, "message" => "A password is required"]]);
        exit();
    }
    //On a passé les vérifications d'intégrité mot de passe et name
    $manager = new Manager($connexion);
    $author = $manager->getAuthorConnect($_GET['name'], $_GET['password']);//On va chercher si c'est un author, revoie la ligne de la bdd si user et mot de passe correspondent
    
    if(empty($author)){//False si l'author a été trouvé, mais que le mdp ne correspond pas
        $tourOperator = $manager->getTourOperatorConnect($_GET['name'], $_GET['password']);
        if(empty($tourOperator)){
            echo json_encode(["error" => ["code" => 3, "message" => "Wrong password"]]);
        }
        else{
            unset($tourOperator['password']);
            $_SESSION['user']['to'] = $tourOperator;
            echo json_encode(["type" => "to", "name" => $tourOperator['name']]);
        }
    }
    else{
        unset($author['password']);
        $_SESSION['user']['author'] = $author;
        echo json_encode(["type" => "author", "name" => $author['name']]);
    }
}