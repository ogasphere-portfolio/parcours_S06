<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\core\CoreController;


// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
       $this->show('main/home') ; 
    }
}
