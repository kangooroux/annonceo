<?php

namespace Service;

class Container
{
    private $configuration;

    private $pdo;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
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
}