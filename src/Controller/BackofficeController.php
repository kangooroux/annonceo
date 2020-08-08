<?php

namespace App\Controller;
use App\Service\Sanitizer;
use App\Service\UserManager;

class BackofficeController extends AbstractController
{

    public function __construct(array $path, array $post, array $session, array $db)
    {
        $this->path;
        $this->path = $path;
        $this->post = $post;
        $this->session = $session;
        $this->db = $db;

        $this->dispatch();
    }

    public function stats()
    {
        include dirname(__DIR__). '../src/View/admin_header.php';
        include dirname(__DIR__). '../src/View/stats.php';
        include dirname(__DIR__). '../src/View/admin_footer.php';
    }

}