<?php


namespace App\Service;


class UserManager extends AbstractUser
{
    private $pdo;

    public function __construct(\PDO $pdo, array $user)
    {
        $this->pdo = $pdo;
    }

    public function createUser($userArray)
    {
        $statement = $this->pdo->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, telephone, civilite, statut, date_enregistrement)');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$shipArray) {
            return null;
        }

        return $shipArray;
    }
}