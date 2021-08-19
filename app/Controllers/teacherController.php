<?php
namespace App\Controllers;



use App\core\CoreModel;
use App\Models\Teacher;
use App\core\CoreController;


// todo passer la partie connexion dans AuthController

class TeacherController extends CoreController {

    
    
   
    
    public function teachers()
    {
        
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets
        $teachers = Teacher::findAll();

        $this->show('teacher/list', [
            'teachers' => $teachers,
        ]);
    }

    public function displayNewTeacher()
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('teacher/add', [
            'token' => $randToken
        ]);
       
    }

    public function displayUpdateTeacher($id)
    {

        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('teacher/edit', [
            'token' => $randToken
        ]);
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $teacher = Teacher::find($id);

        if ($teacher) {
            $this->show('teacher/edit', [
                'teacher' => $teacher,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
    }

    public function createTeacher()
    {
       
        global $router;

        // Recuperer le contenu du formulaire
        // Valider le contenu du formulaire
        $firstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $job = filter_input(INPUT_POST, 'job', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $firstname = CoreModel::valid_donnees($_POST["firstname"]);
        $lastname = CoreModel::valid_donnees($_POST["lastname"]);
        $job = CoreModel::valid_donnees($_POST["job"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        

        $error = false;
        if($firstname === '') {
            $_SESSION['errorMessage'] = "prénom non fourni";
            $error = true;
        } elseif($lastname === '') {
            $_SESSION['errorMessage'] = "Nom non fourni";
            $error = true;
        } elseif($job === '') {
            $_SESSION['errorMessage'] = "Job non fourni";
            $error = true;
        } elseif($status === '') {
            $_SESSION['errorMessage'] = "Status non fourni";
            $error = true;
        }

        if($error) {
            header('Location: ' . $router->generate('teacher-displayNewTeacher'));
            exit();
        }
        // J'instancie une nouvelle categorie vide
        $newTeacher = new Teacher();

        // Je remplis mon user avec les données du formulaire
        
        $newTeacher->setFirstname($firstname);
        $newTeacher->setLastname($lastname);
        $newTeacher->setJob($job);
        $newTeacher->setStatus($status);

        // Inserer le contenu du formulaire en BDD
        
        $newTeacher->save();

        header('location: ' . $router->generate('user-users'));
        exit();
        // Rediriger vers une page pertinente


    }

    public function updateTeacher($teacherId)
    {
       

        global $router;

        //je récupère les données entrées dans le formulaire
        
        $firstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $job = filter_input(INPUT_POST, 'job', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $firstname = CoreModel::valid_donnees($_POST["firstname"]);
        $lastname = CoreModel::valid_donnees($_POST["lastname"]);
        $job = CoreModel::valid_donnees($_POST["job"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        
        //je récupère l'id du user qu'on veut modifier
        $findTeacherById = Teacher::find($teacherId);
       
        
        // je définis les nouvelles données via nos setter correspondants
        
        $findTeacherById->setFirstname($firstname);
        $findTeacherById->setLastname($lastname);
        $findTeacherById->setJob($job);
        $findTeacherById->setStatus($status);



        
        // j'envoie la méthode update pour mettre à jour la BDD et je redirige vers la liste des Users mis à jour.
        $findTeacherById->save();
        header('Location: ' . $router->generate('teacher-teachers'));

    }
    public function deleteTeacher($id)
    {
        
        global $router;

        Teacher::delete($id);
        header('location: ' . $router->generate('teacher-teachers'));
        exit();
    }
}