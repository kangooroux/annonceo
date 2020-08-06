<?php

namespace App;

class Router
{
    private $path;

    /**
     * Router constructor.
     * @param $path
     */
    public function __construct(string $path)
    {
        //Injection de dépendance avec un type string, donc pas besoin de tester si null.
        //Comme ton setter ne fait rien de spécial, pas besoin de passer par lui non plus. Getter & setter dégagés.
        $this->path = $path;
        //La méthode pour lancer le dispatch est désormais appelée depuis le index.php (ça se discute)
    }

    //A travailler un peu pour découpler la lecture de l'url avec l'envoi vers les controlleurs.
    //2 actions différentes !
    public function dispatch() {
        if ($this->path == '/annonceo/connection/') {
            require('../View/page_connexion.php');
        } elseif($this->path == '/annonceo/inscription/') {
            require('../View/page_inscription.php');
        } elseif($this->path == '/annonceo/' ) {
            require_once('public/index.php');
        } else {
            //Ici on suppose qu'aucune route n'a matché donc c'est plutôt une erreur métier
            throw new \Exception("Pas de route trouvée !");
        }
    }

    //La fonction pour découper l'url en différents morceaux qui t'intéressent,
    //à découpler du dispatch qui t'envoie sur les controlleurs, 2 actions différentes !
    //parse peut renvoyer un array avec les parties de l'url par exemple
    //Comme ça tu peux l'appeler dans dispatch, et lire par exemple l'index 0 du array.
    private function parse(): array
    {

    }
}