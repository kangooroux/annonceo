<?php


namespace App\Controller;


class SecurityController
{
    private $title;

    public function __construct()
    {

    }

    private function dispatch()
    {

    }

    public function login()
    {
        $title = 'Inscription';
        require_once(dirname(__DIR__).'../View/page_connexion.php');
    }

    public function register()
    {
        $title = 'Inscription';
        require_once(dirname(__DIR__).'../View/page_inscription.php');
    }

    public function logout()
    {
        $_SESSION = array();
        $this->title = 'Accueil';
        require_once(dirname(__DIR__).'../View/header.php');
        require_once(dirname(__DIR__).'../View/accueil.php');
        require_once(dirname(__DIR__).'../View/footer.php');
    }
}