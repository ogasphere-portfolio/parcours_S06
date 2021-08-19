<?php
namespace App\Controllers;


use App\core\CoreModel;
use App\Models\AppUser;
use App\core\CoreController;



// todo passer la partie connexion dans AuthController

class AppUserController extends CoreController {

    
    
   
    
    public function users()
    {
        
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets
        $users = AppUser::findAll();

        $this->show('appuser/list', [
            'users' => $users,
        ]);
    }

    public function displayNewUser()
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('appuser/add', [
            'token' => $randToken
        ]);
       
    }

    public function displayUpdateUser($id)
    {

        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('appuser/edit', [
            'token' => $randToken
        ]);
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $user = AppUser::find($id);

        if ($user) {
            $this->show('appuser/edit', [
                'user' => $user,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
    }

    public function createUser()
    {
       
        global $router;

        // Recuperer le contenu du formulaire
        // Valider le contenu du formulaire
        $email = filter_input(INPUT_POST, 'email', \FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'name', \FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $email = CoreModel::valid_donnees($_POST["email"]);
        $password = CoreModel::valid_donnees($_POST["password"]);
        $name = CoreModel::valid_donnees($_POST["name"]);
        $role = CoreModel::valid_donnees($_POST["role"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        

        $error = false;
        if($email === '') {
            $_SESSION['errorMessage'] = "Email non fourni";
            $error = true;
        } elseif ($name === '') {
            $_SESSION['errorMessage'] = "Nom non fourni";
            $error = true;
        } elseif($password === '') {
            $_SESSION['errorMessage'] = "Password non fourni";
            $error = true;
        } elseif($role === '') {
            $_SESSION['errorMessage'] = "Role non fourni";
            $error = true;
        } elseif($status === '') {
            $_SESSION['errorMessage'] = "Status non fourni";
            $error = true;
        }

        if($error) {
            header('Location: ' . $router->generate('user-displayNewUser'));
            exit();
        }
        // J'instancie une nouvelle categorie vide
        $newUser = new Appuser();

        // Je remplis mon user avec les données du formulaire
        $newUser = new AppUser();
        $newUser->setEmail($email);
        $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $newUser->setName($name);
        $newUser->setRole($role);
        $newUser->setStatus($status);

        // Inserer le contenu du formulaire en BDD
        
        $newUser->save();

        header('location: ' . $router->generate('user-users'));
        exit();
        // Rediriger vers une page pertinente


    }

    public function updateUser($userId)
    {
       

        global $router;

        //je récupère les données entrées dans le formulaire
        $newEmail = filter_input(INPUT_POST, 'email', \FILTER_SANITIZE_EMAIL);
        $newPassword = filter_input(INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
        $newName = filter_input(INPUT_POST, 'name', \FILTER_SANITIZE_STRING);
        $newRole = filter_input(INPUT_POST, 'role', \FILTER_SANITIZE_STRING);
        $newStatus = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $newEmail = CoreModel::valid_donnees($_POST["email"]);
        $newPassword = CoreModel::valid_donnees($_POST["password"]);
        $newName = CoreModel::valid_donnees($_POST["name"]);
        $newRole = CoreModel::valid_donnees($_POST["role"]);
        $newStatus = CoreModel::valid_donnees($_POST["status"]);
        
        //je récupère l'id du user qu'on veut modifier
        $findUserById = AppUser::find($userId);
       
        
        // je définis les nouvelles données via nos setter correspondants
        $findUserById->setEmail($newEmail);
        $findUserById->setPassword($newPassword);
        $findUserById->setFirstname($newName);
        $findUserById->setRole($newRole);
        $findUserById->setStatus($newStatus);




        
        // j'envoie la méthode update pour mettre à jour la BDD et je redirige vers la liste des Users mis à jour.
        $findUserById->save();
        header('Location: ' . $router->generate('user-users'));

    }
    public function deleteAppUser($id)
    {
        
        global $router;

        AppUser::delete($id);
        header('location: ' . $router->generate('user-users'));
        exit();
    }
}