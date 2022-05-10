<?php

use OProfile\Controllers\UserController;

// je fabrique un objetr alto router
$router = new AltoRouter();

// Je récupère la partie de l'URL qui ne vas pas bouger !
// J'utilise la superglobale $_SERVER dans laquelle j'ai une entrée SCRIPT_NAME
// Qui va me donner le nom du fichier en cours d'execution
// Il ne me reste plus qu'a retirer le nom du fichier (/index.php)
// Pour récupérer ma base URI
$baseURI = str_replace(
    '/index.php',
    '',
    $_SERVER['SCRIPT_NAME']
);

// Pour permettre le bon fonctionnement de mon $router, 
// je dois lui donner la partie de l'URL qui ne bouge pas 
$router->setBasePath($baseURI);

$router->map(
    // methode HTTP a surveiller
    'GET',
    // URL a matcher
    '/user/home/',
    function () {
        // instanciation du controller
        $controller = new UserController();
        // appel de la methode home
        $controller->home();
    },
    'user-home'
);


$router->map(
    // methode HTTP a surveiller
    'GET',
    // URL a matcher
    '/user/hello/',
    function () {
        // instanciation du controller
        $controller = new UserController();
        // appel de la methode home
        $controller->hello();
    },
    'user-hello'
);

// je viens vérifier si l'URL actuelle correspond a une URL
// qui aurait été donnée dans la définition d'une des routes
$match = $router->match();

// var_dump($match);
// die();
// si la route existe bien $match va etre un tableau associatif qui va contenir toutes les informations de la route
// $match['name'] -> je vais avoir le nom de ma route (4eme argument donné a match)
// $match['target'] -> je vais avoir la fonction a executer (3eme argument donné a match)

if ($match) {
    // si la route existe bien
    // je récupère la fonction a éxecuter (3eme argument qui a été donné lors de la définition des routes)
    $functionToCall = $match['target'];
    // ... et je l'execute ! 
    $functionToCall();
} else {
    echo "La route n'existe pas !!";
}