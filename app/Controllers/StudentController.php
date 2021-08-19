<?php
namespace App\Controllers;



use App\core\CoreModel;

use App\Models\Student;
use App\core\CoreController;


// todo passer la partie connexion dans AuthController

class TeacherController extends CoreController {

 
    
    public function students()
    {
        
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets

        $students = Student::findAll();

        $this->show('student/list', [
            'students' => $students,
        ]);
    }

    public function displayNewstudent()
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('student/add', [
            'token' => $randToken
        ]);
       
    }

    public function displayUpdateStudent($id)
    {

        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('student/edit', [
            'token' => $randToken
        ]);
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $student = Student::find($id);

        if ($student) {
            $this->show('student/edit', [
                'student' => $student,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
    }

    public function createStudent()
    {
       
        global $router;

        // Recuperer le contenu du formulaire
        // Valider le contenu du formulaire
        $firstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);
        $teacher_id = filter_input(INPUT_POST, 'teacher_id', \FILTER_SANITIZE_NUMBER_INT);

        $firstname = CoreModel::valid_donnees($_POST["firstname"]);
        $lastname = CoreModel::valid_donnees($_POST["lastname"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        $teacher_id = CoreModel::valid_donnees($_POST["teacher_id"]);
        

        $error = false;
        if($firstname === '') {
            $_SESSION['errorMessage'] = "prénom non fourni";
            $error = true;
        } elseif($lastname === '') {
            $_SESSION['errorMessage'] = "Nom non fourni";
            $error = true;
        } elseif($status === '') {
            $_SESSION['errorMessage'] = "Status non fourni";
            $error = true;
        }

        if($error) {
            header('Location: ' . $router->generate('student-displayNewStudent'));
            exit();
        }
        // J'instancie une nouvelle categorie vide
        $newStudent = new Student();

        // Je remplis mon user avec les données du formulaire
        
        $newStudent->setFirstname($firstname);
        $newStudent->setLastname($lastname);
        $newStudent->setTeacher_id($teacher_id);
        $newStudent->setStatus($status);

        // Inserer le contenu du formulaire en BDD
        
        $newStudent->save();

        header('location: ' . $router->generate('student-students'));
        exit();
        // Rediriger vers une page pertinente


    }

    public function updateStudent($studentId)
    {
       

        global $router;

        //je récupère les données entrées dans le formulaire
        
        $firstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);
        $teacher_id = filter_input(INPUT_POST, 'teacher_id', \FILTER_SANITIZE_NUMBER_INT);

        $firstname = CoreModel::valid_donnees($_POST["firstname"]);
        $lastname = CoreModel::valid_donnees($_POST["lastname"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        $teacher_id = CoreModel::valid_donnees($_POST["teacher_id"]);
        
        
        //je récupère l'id du user qu'on veut modifier
        $findStudentById = Student::find($studentId);
       
        
        // je définis les nouvelles données via nos setter correspondants
        
         
        $findStudentById->setFirstname($firstname);
        $findStudentById->setLastname($lastname);
        $findStudentById->setTeacher_id($teacher_id);
        $findStudentById->setStatus($status);



        
        // j'envoie la méthode update pour mettre à jour la BDD et je redirige vers la liste des Users mis à jour.
        $findStudentById->save();
        header('Location: ' . $router->generate('student-students'));

    }
    public function deleteStudent($id)
    {
        
        global $router;

        Student::delete($id);
        header('location: ' . $router->generate('student-students'));
        exit();
    }
}