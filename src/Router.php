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
}