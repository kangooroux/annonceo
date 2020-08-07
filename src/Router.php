<?php

namespace App;
use App\Controller\BackofficeController;
use App\Controller\FrontofficeController;
use App\Controller\SecurityController;
use App\Service\Sanitizer;


class Router
{

    private $db;
    private $path;
    private $global;
    private $sanitizer;
    private $post;
    private $sesssion;

    /**
     * Router constructor.
     * @param null $path
     * @throws \Exception
     */
    public function __construct($db, $global)
    {
        $this->db = $db;
        $this->global = $global;
        $this->sanitizer = new Sanitizer();
    }

    public function dispatch() {
        $path = $this->parse();

        //3 controleurs
        //back --> /admin
        //front -->
        //security --> /inscription /connection

        if (isset($this->global['_POST'])) {
            $this->post = $this->global['_POST'];
        }
        if (isset($this->global['_SESSION'])) {
            $this->sesssion = $this->global['_SESSION'];
        }
        if (isset($this->post['logout'])) {
            $disconnect = new SecurityController();
            $disconnect->logout();
            die;
        } elseif (isset($this->sesssion['last_name']) && isset($this->sesssion['first_name']) && isset($this->sesssion['user_id'])) {

            if ($path[1] == 'admin') {
                $bo = new BackofficeController($this->path, $this->post, $this->sesssion, $this->db);
            } else {
                //pageActeurs();
            }
        } elseif (isset($this->post['pseudo']) && ($this->post['password']) && ($this->post['lastname']) && ($this->post['firstname']) && ($this->post['email']) && ($this->post['phone_number']) && ($this->post['civilite'])) {
            $pseudo = $this->sanitizer;
            $backofficeController = new BackofficeController($this->db);
            $backofficeController->registerNewUser($sanitizedPostValues->sanatizedItems);
        } elseif ($path[1] == 'accueil' || $path[1] == '') {
            $fc = new FrontofficeController();
            $fc->getHomepage();
        } elseif ($path[1] == 'connexion') {
            $loginPage = new SecurityController();
            $loginPage->login();
        } elseif ($path[1] == 'inscription') {
            $registerPage = new SecurityController();
            $registerPage->register();
        } elseif ($path[1] == 'annonces') {
            //mentionslegales();
        } else {
            throw new \Exception('Pas de route trouvée !');
        }
    }

    /**
     * @return false|string[]
     * si j'ai demandé locahost/annonces/4/edit
     * Il doit me retourner un array ['annonces', '4', 'edit']
     */
    private function parse()
    {
        $sanitizedPath = $this->sanitizer->sanitizeString($this->global['_SERVER']['REQUEST_URI']);
        $explodedPath = explode("/", $sanitizedPath);
        return $explodedPath;
        //un bon gros explode autour des /
        //explode doit te rendre les mots de l'url dans un tableau
        //return le tableau

        //http://localhost/security
            //http://localhost/security/login
            //http://localhost/security/register
            //http://localhost/security/profil
            //http://localhost/security/etc....
        //http://localhost/annonces
            //http://localhost/annonces/index
            //http://localhost/annnonces/[id] (show)
            //http://localhost/annonces/create
            //http://localhost/annonces/[id]/edit (pour l'édition)
        //http://localhost/admin
            //http://localhost/admin/stats
            //http://localhost/admin/annonces
            //http://localhost/admin/categories
            //http://localhost/admin/notes
            //http://localhost/admin/membres

    }
}