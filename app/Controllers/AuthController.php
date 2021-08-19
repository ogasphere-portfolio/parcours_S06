<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\core\CoreController;

class AuthController extends CoreController
{
    public function connexion()
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('connexion/login', [
            'token' => $randToken
        ]);
        
    }

    public function connexionControl()
    {
        global $router;
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        // Recuperation de l'utilisateur via son email
        $connectedUser = AppUser::findByEmail($email);

        // Si l'email existe dans la BDD
        if($connectedUser) {
            // Comparer le mdp avec celui lié au compte
            if(password_verify($password, $connectedUser->getPassword())) {
                // On ajoute en session l'objet de l'utilisateur connecté
                $_SESSION['connectedUser'] = $connectedUser;
                // On redirige vers l'accueil
                header('Location:' . $router->generate('main-home'));
            } else {
                $_SESSION['errorMessage'] = "ERREUR DE CONNEXION MDP";
                header('Location:' . $router->generate('user-connexion'));
            }

        } else {
            $_SESSION['errorMessage'] = "ERREUR DE CONNEXION";
            header('Location:' . $router->generate('user-connexion'));
        }
    }
    public function disconnect()
    {
        global $router;
        // suppression du connectedUser
        unset($_SESSION['connectedUser']);
        // Redirection vers la page de connexion
        header('Location: ' . $router->generate('user-connexion'));
    }
}