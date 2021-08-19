<?php

global $router;

// Routes pour la page home
$router->map('GET','/',['method' => 'home','controller' => '\App\Controllers\MainController'],'main-home');



// Partie connexion à l'administration du site
$router->map('GET','/connexion/login',['method' => 'connexion','controller' => '\App\Controllers\AuthController'],'auth-connexion');
$router->map('POST','/connexion/login',['method' => 'connexionControl','controller' => '\App\Controllers\AuthController'],'auth-connexion-control');
$router->map('GET','/deconnexion',['method' => 'disconnect','controller' => '\App\Controllers\AuthController'],'auth-disconnect');

// Routes pour les utilisateurs
$router->map('GET','/users',['method' => 'users','controller' => '\App\Controllers\AppUserController'],'user-users');
$router->map('GET','/user/edit/[i:id]',['method' => 'displayUpdateUser','controller' => '\App\Controllers\AppUserController'],'user-displayUpdateUser');
$router->map('GET','/user/new',['method' => 'displayNewUser','controller' => '\App\Controllers\AppUserController'],'user-displayNewUser');
$router->map('POST','/user/update/[i:id]',['method' => 'updateUser','controller' => '\App\Controllers\AppUserController'],'user-updateUser');
$router->map('POST','/user/new',['method' => 'createUser','controller' => '\App\Controllers\AppUserController'],'user-createUser');
$router->map('GET','/user/delete/[i:id]',['method' => 'deleteUser','controller' => '\App\Controllers\AppUserController'],'user-deleteUser');



// Routes pour les Teachers
$router->map('GET','/teachers',['method' => 'teachers','controller' => '\App\Controllers\TeacherController'],'teacher-teachers');
$router->map('GET','/teachers/add',['method' => 'displayNewTeacher','controller' => '\App\Controllers\TeacherController'],'teacher-displayNewTeacher');
$router->map('POST','/teachers/add',['method' => 'createTeacher','controller' => '\App\Controllers\TeacherController'],'teacher-createTeacher');
$router->map('GET','/teachers/[i:id]',['method' => 'displayUpdateTeacher','controller' => '\App\Controllers\TeacherController'],'teacher-displayUpdateTeacher');
$router->map('POST','/teachers/[i:id]',['method' => 'updateTeacher','controller' => '\App\Controllers\TeacherController'],'teacher-updateTeacher');
$router->map('GET','/teachers/delete/[i:id]',['method' => 'deleteTeacher','controller' => '\App\Controllers\TeacherController'],'teacher-deleteTeacher');


// Routes pour les Students
$router->map('GET','/students',['method' => 'students','controller' => '\App\Controllers\StudentController'],'student-students');
$router->map('GET','/students/add',['method' => 'displayNewStudent','controller' => '\App\Controllers\StudentController'],'student-displayNewStudent');
$router->map('POST','/students/add',['method' => 'createStudent','controller' => '\App\Controllers\StudentController'],'student-createStudent');
$router->map('GET','/students/[i:id]',['method' => 'displayUpdateStudent','controller' => '\App\Controllers\StudentController'],'student-displayUpdateStudent');
$router->map('POST','/students/[i:id]',['method' => 'updateStudent','controller' => '\App\Controllers\StudentController'],'student-updateStudent');
$router->map('GET','/students/delete/[i:id]',['method' => 'deleteStudent','controller' => '\App\Controllers\StudentController'],'student-deleteStudent');


