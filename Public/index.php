<?php

//Appel de l'autoload
require dirname(__DIR__).'/vendor/autoload.php';

//test d'importation du fichier env.php avec les accès à la bdd. Si ça marche pas on va pas plus loin.
try {
    if (!file_exists(dirname(__DIR__).'/env.php')) throw new Exception ('env.php does not exist, create it or copy it from env.php.template');
    else require_once dirname(__DIR__).'/env.php';
} catch(Exception $e) {
    echo "Message : " . $e->getMessage();
}

use App\Router;


try {
    $router = new Router($db);
    $router->dispatch();
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    //En cas de dispatch raté, on affiche l'erreur ici. Le message est envoyé à la vue.
    require('../View/error.php');
}


