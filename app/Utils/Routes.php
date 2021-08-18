<?php
// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
global $router;

// Routes pour la page home
$router->map('GET','/',['method' => 'home','controller' => '\App\Controllers\MainController'],'main-home');

// Routes pour les catégories
$router->map('GET','/categories',['method' => 'categories','controller' => '\App\Controllers\CategoryController'],'category-categories');
$router->map('GET','/category/edit/[i:id]',['method' => 'displayUpdateCategory','controller' => '\App\Controllers\CategoryController'],'category-displayUpdateCategory');
$router->map('GET','/category/new',['method' => 'displayNewCategory','controller' => '\App\Controllers\CategoryController'],'category-displayNewCategory');
$router->map('POST','/category/update/[i:id]',['method' => 'updateCategory','controller' => '\App\Controllers\CategoryController'],'category-updateCategory');
$router->map('POST','/category/new',['method' => 'createCategory','controller' => '\App\Controllers\CategoryController'],'category-createCategory');
$router->map('GET','/category/delete/[i:id]',['method' => 'deleteCategory','controller' => '\App\Controllers\CategoryController'],'category-deleteCategory');

// Routes pour les produits
$router->map('GET','/products',['method' => 'products','controller' => '\App\Controllers\ProductController'],'product-products');
$router->map('GET','/product/new',['method' => 'displayNewProduct','controller' => '\App\Controllers\ProductController'],'product-displayNewProduct');
$router->map('GET','/product/edit/[i:id]',['method' => 'displayUpdateProduct','controller' => '\App\Controllers\ProductController'],'product-displayUpdateProduct');
$router->map('POST','/product/update/[i:id]',['method' => 'updateProduct','controller' => '\App\Controllers\ProductController'],'product-updateProduct');
$router->map('POST','/product/new',['method' => 'createProduct','controller' => '\App\Controllers\ProductController'],'product-createProduct');
$router->map('GET','/product/delete/[i:id]',['method' => 'deleteProduct','controller' => '\App\Controllers\ProductController'],'product-deleteProduct');

// Routes pour les Types
$router->map('GET','/type',['method' => 'findType','controller' => '\App\Controllers\TypeController'],'type-types');
$router->map('GET','/type/[i:id]',['method' => 'findTypeById','controller' => '\App\Controllers\TypeController'],'type-type-by-id');

// Routes pour les marques
$router->map('GET','/brand',['method' => 'findBrand','controller' => '\App\Controllers\BrandController'],'brand-brands');
$router->map('GET','/brand/[i:id]',['method' => 'findBrandById','controller' => '\App\Controllers\BrandController'],'brand-brand-by-id');

// Routes pour la tags
$router->map('GET','/tag',['method' => 'findTag','controller' => '\App\Controllers\TagController'],'tag-tags');
$router->map('GET','/tag/[i:id]',['method' => 'findTagById','controller' => '\App\Controllers\TagController'],'tag-tag-by-id');

// Partie connexion à l'administration du site
$router->map('GET','/connexion/login',['method' => 'connexion','controller' => '\App\Controllers\AppUserController'],'user-connexion');
$router->map('POST','/connexion/login',['method' => 'connexionControl','controller' => '\App\Controllers\AppUserController'],'user-connexion-control');
$router->map('GET','/deconnexion',['method' => 'disconnect','controller' => '\App\Controllers\AppUserController'],'user-disconnect');

// Routes pour les utilisateurs
$router->map('GET','/users',['method' => 'users','controller' => '\App\Controllers\AppUserController'],'user-users');
$router->map('GET','/user/edit/[i:id]',['method' => 'displayUpdateUser','controller' => '\App\Controllers\AppUserController'],'user-displayUpdateUser');
$router->map('GET','/user/new',['method' => 'displayNewUser','controller' => '\App\Controllers\AppUserController'],'user-displayNewUser');
$router->map('POST','/user/update/[i:id]',['method' => 'updateUser','controller' => '\App\Controllers\AppUserController'],'user-updateUser');
$router->map('POST','/user/new',['method' => 'createUser','controller' => '\App\Controllers\AppUserController'],'user-createUser');



// Routes pour l'administration de la page home

$router->map('GET','/categories/order',['method' => 'categoriesOrderForm','controller' => '\App\Controllers\CategoryController'],'category-categoriesOrderForm');
$router->map('POST','/categories/order',['method' => 'categoriesOrderAction','controller' => '\App\Controllers\CategoryController'],'category-categoriesOrderAction');
// Exemple de route avec mise en forme plus lisible
/* $router->map(
    'POST',
    '/user/update/[i:id]',
    [
        'method' => 'updateUser',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-updateUser'
);
 */