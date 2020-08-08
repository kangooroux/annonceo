<?php


namespace App\Service;


class MembreManager extends Membre
{
    private $pdo;

    public function __construct(\PDO $pdo, array $user)
    {
        $this->pdo = $pdo;
    }

    private function isPseudoExistInDb()
    {

    }

    public function createMembre($userArray)
    {
        $statement = $this->pdo->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, telephone, civilite, statut, date_enregistrement) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
        $statement->execute(array(
            'pseudo' => $userArray['pseudo'],
            'mdp' => $userArray['pseudo'],
            'nom' => $userArray['pseudo'],
            'prenom' => $userArray['pseudo'],
            'telephone' => $userArray['pseudo'],
            'civilite' => $userArray['pseudo'],
            'statut' => '0',

            ));
        return $statement;
    }
}