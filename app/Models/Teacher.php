<?php


class AppUser extends CoreModel
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    
    public static function findByEmail(string $email): ?self
    {
        // Recuperation connexion BDD
        $pdo = Database::getPDO();

        // Preparation de la requete avec placeholder
        $sql = '
            SELECT * FROM `app_user` WHERE email = :email;
        ';
        $request = $pdo->prepare($sql);

        // Execution de la requete en remplacant les placeholders par
        // les parametres
        $result = $request->execute([
            ':email' => $email
        ]);

        if($result) {
            return $request->fetchObject('App\Models\AppUser');
        }
        return false;

    }

    public static function find($id)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `app_user` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $user = $pdoStatement->fetchObject('App\Models\AppUser');

        // retourner le résultat
        return $user;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\AppUser');
        
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
                INSERT INTO `app_user` (`email`, `password`,`firstname`, `lastname`, `role`, `status`)
                VALUES (
                    :email, 
                    :password,
                    :firstname,
                    :lastname,
                    :role,
                    :status
                        )";

        $request = $pdo->prepare($sql);

        $insertedRows = $request->execute([
            ':email' => $this->getEmail(),
            ':password' => $this->getPassword(),
            ':firstname' => $this->getFirstname(),
            ':lastname' => $this->getLastname(),
            ':role' => $this->getRole(),
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
            UPDATE `user`
            SET
            email = :email,
            password = :password,
            firstname = :firstname,
            lastname = :lastname,
            role  = :role,
            status = :status
            WHERE id=:id
        ";

        $request = $pdo->prepare($sql);
        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $request->execute([
            ':email' => $this->email,        
            ':password' => \password_hash($this->password, \PASSWORD_DEFAULT ),
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':role' => $this->role,
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
        $sql = 'DELETE FROM `app_user` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->exec($sql);
        return $pdoStatement;
    }

