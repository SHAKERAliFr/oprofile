<?php

namespace OProfile\Controllers;

use WP_Query;

class UserController extends CoreController
{


    /**
     * getProfile
     * 
     * Methode qui va nous permettre de récupérer la fiche profile pour un user 
     *
     * @param [type] Object
     * @return void
     */
    public function getProfile($user)
    {
        // nous demandons à wordpress de nous selectionner le post de type "developer-profile" dont l'auteur est le $user demandé

        $options = [
            'author' => $user->ID,
            'post_type' => 'developer-profile'
        ];

        // j'execute une requete
        $query = new WP_Query($options);

        // si on a bien des posts
        $query->have_posts();
        // on va compter le nombre de posts
        if (count($query->posts) === 0) {
            echo "Le compte utilisateur est corrompu";
            exit();
        } else {
            return $query->posts[0];
        }
    }




    /**
     * home
     * 
     * Methode executée lorsque je suis sur l'adresse user/home
     *
     * @return void
     */
    public function home()
    {
        // on veut vérifier si l'utilisateur est bien connecté
        $this->mustBeConnected();

        // récupération de l'utilisateur actuellement connecté
        $user = wp_get_current_user();
        // var_dump($user); 

        // récupération de la fiche profil du user connecté
        // rappel : lors de l'inscritpion je vais générer une fiche profil qui sera associé au user
        // !attention, pour l'instant le mecanisme 
        //! ne vas marcher que pour les 'developers'
        $profile = $this->getProfile($user);


        $this->show('views/user/home', $profile);
    }

    /**
     * hello
     * 
     * is it me you're looking fooooooor ?
     * Methode executée quand je suis sur l'adresse /user/hello
     *
     * @return void
     */
    public function hello()
    {
        //avant d'afficher la vue 
        // je récupère tout un tas d'information
        // echo 'je suis hello';

        $tousUnTasDinfos = [
            'info1' => 'blabla info1'
        ];

        $this->show('views/user/hello', $tousUnTasDinfos);
    }
}
