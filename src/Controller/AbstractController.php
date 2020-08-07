<?php


namespace App\Controller;


abstract class AbstractController
{
    protected $db;

    private $pdo;

    /**
     * @return \PDO
     */
    public function getPDO()
    {
        try {
            if ($this->pdo === null) {
                $this->pdo = new \PDO(
                    $this->db['db_dsn'],
                    $this->db['db_user'],
                    $this->db['db_pass']
                );

                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        } catch (\Exception $e) {
            echo $e;
        }

        return $this->pdo;
    }
}