<?php


namespace App;


class Router
{
    private $path;

    /**
     * Router constructor.
     * @param $path
     */
    public function __construct($path)
    {
        if (!$path == null) {
            $this->setPath($path);
        }
        $this->getPage($this->getPath());
    }

    /**
     * @return mixed
     */
    private function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }



    private function getPage($path) {
        if ($path == '/annonceo/connection/') {
            require('view/page_connexion.php');
        } elseif($path == '/annonceo/inscription/') {
            require('view/page_inscription.php');
        } elseif($path == '/annonceo/' ) {
            require_once('index.php');
        } else {
            echo $this->getPath();
            var_dump($this->getPath());
            require('view/error.php');
        }
    }
}