<?php
namespace App\Models;

use PDO;
use App\core\CoreModel;
use App\Utils\Database;


class Student extends CoreModel
{
    
    private $firstname;
    private $lastname;
    private $status;
    private $teacher_id;
    
    

    public static function find($id)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `student` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $user = $pdoStatement->fetchObject('App\Models\Student');

        // retourner le résultat
        return $user;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Student');
        
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
                INSERT INTO `student` (`firstname`, `lastname`, `status`, `teacher_id`)
                VALUES (
                    :firstname,
                    :lastname,
                    :status,
                    :teacher_id
                    )";

        $request = $pdo->prepare($sql);

        $insertedRows = $request->execute([
            ':firstname' => $this->getFirstname(),
            ':lastname' => $this->getLastname(),
            ':status' => $this->getStatus(),
            ':teacher_id' => $this->getTeacher_id()
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
            UPDATE `student`
            SET
            
            firstname = :firstname,
            lastname = :lastname,
            status  = :status,
            teacher_id = :teacher_id
            WHERE id=:id
        ";

        $request = $pdo->prepare($sql);
        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $request->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':status' => $this->status,
            ':teacher_id' => $this->teacher_id,
            ':id'=> $this->id,
        ]);

    
        // On retourne VRAI, si au moins une ligne ajoutée
    return ($updatedRows > 0);
        
    }


    public static function delete($id)
    {
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'DELETE FROM `student` WHERE `id` =' . $id;

        // exécuter notre requête
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

    /**
     * Get the value of teacher_id
     */ 
    public function getTeacher_id()
    {
        return $this->teacher_id;
    }

    /**
     * Set the value of teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }
}
