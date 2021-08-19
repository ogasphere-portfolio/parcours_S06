<?php
namespace App\Models;

use PDO;
use App\core\CoreModel;
use App\Utils\Database;


class Teacher extends CoreModel
{
    
    private $firstname;
    private $lastname;
    private $job;
    private $status;

    
    
    public static function find($id)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `teacher` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $user = $pdoStatement->fetchObject('App\Models\Teacher');

        // retourner le résultat
        return $user;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `teacher`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Teacher');
        
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
                INSERT INTO `teacher` (`firstname`, `lastname`, `job`, `status`)
                VALUES (
                    :firstname,
                    :lastname,
                    :job,
                    :status
                        )";

        $request = $pdo->prepare($sql);

        $insertedRows = $request->execute([
            ':firstname' => $this->getFirstname(),
            ':lastname' => $this->getLastname(),
            ':job' => $this->getJob(),
            ':status' => $this->getStatus()
        ]);

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }
    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table app_user
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `teacher`
            SET
            firstname = :firstname,
            lastname = :lastname,
            job  = :job,
            status = :status
            WHERE id=:id
        ";

        $request = $pdo->prepare($sql);
        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $request->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':job' => $this->role,
            ':status' => $this->status,
            ':id'=> $this->id,
        ]);

    
        // On retourne VRAI, si au moins une ligne ajoutée
    return ($updatedRows > 0);
        
    }


    public static function delete($id)
    {
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'DELETE FROM `teacher` WHERE `id` =' . $id;

        // exécuter notre requêterole
        $pdoStatement = $pdo->exec($sql);
        return $pdoStatement;
    }
    
    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of job
     */ 
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @return  self
     */ 
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}

