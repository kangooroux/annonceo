<?php


namespace App\Controller;


use App\Service\Membre;
use App\Service\MembreManager;

class SecurityController extends AbstractController
{

    public function __construct(array $post, array $session, array $db)
    {
        $this->post = $post;
        $this->db = $db;
    }

    public function createNewMembre()
    {
        $newUser = new MembreManager($this->getPDO(), $this->post);
    }

    public function update()
    {
        
    }

    public function logUser()
    {
        
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