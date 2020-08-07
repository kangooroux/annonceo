<?php


namespace App\Controller;


class FrontofficeController
{
    private $title;

    public function __construct()
    {

    }

    public function getHomepage()
    {

        require_once(dirname(__DIR__).'../View/header.php');
        require_once(dirname(__DIR__).'../View/accueil.php');
        require_once(dirname(__DIR__).'../View/footer.php');
    }

}