<?php


namespace App\Controller;


class FrontofficeController
{
    private $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function getPageAccueil()
    {
        $title = $this->title;
        require_once(dirname(__DIR__).'../View/header.php');
        require_once(dirname(__DIR__).'../View/accueil.php');
        require_once(dirname(__DIR__).'../View/footer.php');
    }

    public function getPageConnexion()
    {
        $title = $this->title;
        require_once(dirname(__DIR__).'../View/page_connexion.php');
    }

    public function getPageInsciption()
    {
        $title = $this->title;
        require_once(dirname(__DIR__).'../View/page_inscription.php');
    }
}