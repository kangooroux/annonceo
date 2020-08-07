<?php

namespace App\Controller;
use App\Service\Sanitizer;
use App\Service\UserManager;

class BackofficeController extends AbstractController
{


    /**
     * @var array
     */
    private $path;
    /**
     * @var array
     */
    private $post;
    /**
     * @var array
     */
    private $session;

    public function __construct(array $path, array $post, array $session, array $db)
    {
        $this->db = $db;
        $this->path = $path;
        $this->post = $post;
        $this->session = $session;

        $this->dispatch();
    }

    private function stats()
    {
        include dirname(__DIR__). '../src/View/admin_header.php';
        include dirname(__DIR__). '../src/View/stats.php';
        include dirname(__DIR__). '../src/View/admin_footer.php';
    }

    private function dispatch()
    {
        //ici le but va être de parser le 2eme mot du tableau path.
        //par exemple, je veux que /admin/stats affiche la page des statitiques admin
//        if ($this->path[2] == 'stats') {
//            $this->stats();
//        }
    }
}