<?php
namespace App\core;

use PDO;
use Exception;
use App\Utils\Database;



// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    private $column_names;

    // ici, tous les enfants de cette classe devront déclarer une méthode insert et une méthode update
    // protected est une convention, on mettra toujours protected, pas public, ni static, ni private
    abstract protected function insert();
    abstract protected function update();
    abstract static protected function find($id);
    abstract static protected function findAll();
    abstract static protected function delete($id);

    public function save()
    {
        // On verifie que id existe et qu'il est superieur a 0
        if($this->id && $this->id > 0) {
            $this->update();
            // Update
        } else {
            $this->insert();
            // insert
        }
    }

    public function getColumnNames($table)
    {
        // Méthode pour récuprer le nom des colonnes de $table
        $pdo = Database::getPDO();
        $sql = "select column_name from information_schema.columns where table_name = '{$table}'";

        $pdoStatement = $pdo->prepare($sql);

        try {
            if ($pdoStatement->execute()) {
                $raw_column_data = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($raw_column_data as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if (!(int)$inner_key) {
                            $this->column_names[] = $value;
                        }
                    }
                }
            }
            return $this->column_names;  // on retourne toutes les colonnes de la table passé en parametres
        } catch (Exception $e) {
            return $e->getMessage(); //return exception 
        }
    }

    public function testInsert($table)
    {
        // Todo tentative de mise en place d'un insert dynamique
        
        $pdo = Database::getPDO();
       
;       $fields_list = "";
        $value_list = "";
        $execute_list = [];
       
        // on recupere le nom des colonnes de la table $table
        // todo trouver un moyen de verifier les attributs auto-increment et timestamp pour ne pas les inclure dans la requete
        $columns = $this->getColumnNames($table);
        $cpt = 0;
        foreach ($columns as $col) {
           $cpt++;
           $colUpperFirst = \ucfirst($col); // on passe la premiere lettre du champ en majuscule: getname devient getName

           if ($cpt == 1) {
                $fields_list = "({$col}," ;
                $value_list = "(:{$col}" ;

                // Premiere ligne du tableau associatif qui sera passé en parametre à execute()
                $execute_list[':'.$col] = '$this->get'.$colUpperFirst.',';
           
           } else {
                $fields_list = "{$fields_list},{$col}"; // liste des champs de la requete
                $value_list = "{$value_list},:{$col}"; // liste des Value de la requete

                // les autres lignes du tableau associatif qui sera passé en parametre à execute()
                $execute_list[':'.$col] = '$this->get'.$colUpperFirst.',';
           }
          
        }
        //on ferme la parenthese
        $fields_list = "{$fields_list})";   // ex:pour la table produit $fields_list vaut : "(id,,name,subtitle,picture,home_order,created_at,updated_at)"
        
        // on ferme la parenthese
        $value_list = "{$value_list})"; // ex :pour la table produit $value_list vaut : (:id,:name,:subtitle,:picture,:home_order,:created_at,:updated_at)"
        
       
        dd($execute_list);
        
        // on remplit la requete avec les valeurs dynamiques
        $sql = "
            INSERT INTO `{$table}` {$fields_list}
            VALUES $value_list";


        $request = $pdo->prepare($sql);
       
        
        $insertedRows = $request->execute($execute_list);
       
        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }




    public static function valid_donnees($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param  string  $updated_at
     *
     * @return  self
     */
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}
