<?php


namespace App\Controller;


class FrontofficeController extends AbstractController
{
    
    /**
     *
     * @param array $path
     * @param array $post
     * @param array $session
     * @param array $db
     */
    public function __construct(array $path, array $post, array $session, array $db)
    {
        $this->path;
        $this->path = $path;
        $this->post = $post;
        $this->session = $session;
        $this->db = $db;

        $this->dispatch();
    }

    public function homepage()
    {

        require_once(dirname(__DIR__).'../View/header.php');
        require_once(dirname(__DIR__).'../View/accueil.php');
        require_once(dirname(__DIR__).'../View/footer.php');
    }

    public function getPageAccueil()
    {
        $this->title = 'Accueil';
        require_once(dirname(__DIR__).'../View/header.php');
        require_once(dirname(__DIR__).'../View/accueil.php');
        require_once(dirname(__DIR__).'../View/footer.php');
    }

    public function getPageConnexion()
    {
        $title = 'Conexion';
        require_once(dirname(__DIR__).'../View/page_connexion.php');
    }

    public function getPageInscription()
    {
        $title = 'Inscription';
        require_once(dirname(__DIR__).'../View/page_inscription.php');
    }

    public function getPageProfil()
    {
        
    }

    public function getPageAnnonce()
    {
        
    }

    public function getPageCommenter()
    {
        
    }

    public function getPageDeposerAnnonce()
    {

    }

    public function getPageMentionsLegales()
    {

    }

    public function getPageCGDV()
    {

    }

    public function getAnnonce()
    {

    }

    public function getPageVosAnnonces()
    {
        
    }

    public function getPageVotreAnnonce()
    {
        
    }

    public function editerAnnonce()
    {
        
    }

}