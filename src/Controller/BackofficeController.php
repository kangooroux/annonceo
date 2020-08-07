<?php

namespace App\Controller;
use App\Service\Sanitizer;
use App\Service\UserManager;

class BackofficeController
{
    private $configuration;

    private $pdo;

    private $newUser;

    /**
     * @var array
     */
    private $path;
    /**
     * @var array
     */
    private $server;

    public function __construct(array $path, array $server, array $db)
    {
        $this->configuration = $db;
        $this->path = $path;
        $this->server = $server;
        $this->dispatch();
    }

    /**
     * @return \PDO
     */
    public function getPDO()
    {
        try {
            if ($this->pdo === null) {
                $this->pdo = new \PDO(
                    $this->configuration['db_dsn'],
                    $this->configuration['db_user'],
                    $this->configuration['db_pass']
                );

                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        } catch (\Exception $e) {
            echo $e;
        }

        return $this->pdo;
    }


    /**
     * @param $user
     */
    public function registerNewUser($newUserData)
    {
        //$newUser = new UserManager(getPDO(), $user);
    }

    private function stats()
    {
        include '../src/View/stats.php';
    }

    private function dispatch()
    {
        //ici le but va être de parser le 2eme mot du tableau path.
        //par exemple, je veux que /admin/stats affiche la page des statitiques admin
        if ($this->path[1] == 'stats') {
        $this->stats();
        }
    }
}