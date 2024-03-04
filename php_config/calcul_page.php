<?php

$section = "./pages/index/controleur.php"; // La section par défaut va afficher l'accueil
$js = array("./js/global.js");// On créé un tableau qui va contenir l'adresse de tous les scripts js à executer dans le footer (./htmlElements/footer.php)

// Si l'utilisateur envoie un requête GET pour visiter une section (avec l'url : index.php?s=<section>)
$page = "index";
if(!empty($_GET['s'])){
    $page = $_GET["s"];
    $getSection = "./pages/".$page."/controleur.php";// On construit le chemin qui va chercher la section demmandée (sont controleur, qui va contruire le contenu de la page)
    $getJs = './js/'.$page.'.js';

    if(file_exists($getSection)){// Si la section demmandée existe bien et renvoie bien un fichier ctrl.php, alors on peut valide le chemin, on affichera bien cette nouvelle section
        $section = $getSection;

        if(file_exists($getJs))// On teste aussi si un fichier js existe pour cette section
            $js[] = $getJs;// Si oui on le passe au tableau js qui l'executera dans le footer (./htmlElements/footer.php)
    }
}
else
    $js[] = './js/index.js';