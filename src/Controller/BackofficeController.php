<?php

namespace App\Controller;
use App\Service\Sanitizer;
use App\Service\UserManager;

class BackofficeController
{
    private $configuration;

    private $pdo;

    private $newUser;

    public function __construct(array $db)
    {
        $this->configuration = $db;
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
}