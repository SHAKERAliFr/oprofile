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
        if ($user->roles[0] == 'developer' || $user->roles[0] == 'customer') {
            // nous demandons à wordpress de nous selectionner le post de type "developer-profile" dont l'auteur est le $user demandé
            if ($user->roles[0] == 'developer') {
                $options = [
                    'author' => $user->ID,
                    'post_type' => 'developer-profile'
                ];
            }

            if ($user->roles[0] == 'customer') {
                $options = [
                    'author' => $user->ID,
                    'post_type' => 'customer-profile'
                ];
            }
            // j'execute une requete
            //! tres important
            // https://developer.wordpress.org/reference/classes/wp_query/
            $query = new WP_Query($options);
            // si on a bien des posts
            $query->have_posts();
            // on va compter le nombre de posts
            if (count($query->posts) === 0) {
                echo "Le compte utilisateur est corrompu";
                exit();
            } else {
                //var_dump($query->posts);
                return $query->posts[0];
            }
        } else {
            //todo on pourrait rediriger vers une 404 grace a wp_redirect()
            echo "Cette page n'est pas accessible pour l'admin !";
            die();
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
        $data = [
            'current_user' => $user,
            'fich_profile' => $profile
        ];


        $this->show('views/user/home', $data);
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
