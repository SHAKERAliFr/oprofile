<?php

namespace OProfile\Controllers;

use WP_Query;

class UserController extends CoreController
{


    public function delete()
    {
        if (!$this->mustBeConnected()) {
            // si l'utilisateur n'est pas connecté 
            // je ne veux SURTOUT PAS continuer l'execution de cette methode
            // je peux donc faire un return tout court pour couper l'execution de la methode !
            return;
        }

        // il serait dangereux de supprimer le compte admin non ?
        if ($this->isAdmin()) {
            echo 'Mais ti est fouuuu ! Tu vas supprimer ton compte admin !!!';
            exit();
        }

        //! DONC si l'utilisateur est bien connecté 
        //! ET SURTOUT, SI CE N'EST PAS UN ADMIN
        // on va procéder a la suppression du compte
        $user = wp_get_current_user();

        // Il faut faire un require manuel des fonctions de gestion utilisateurs de wordpress
        // On a pas acces a la fonction wp_delete_user etant donné qu'on est sur un systeme de routing maison.

        require_once(ABSPATH . 'wp-admin/includes/user.php');

        wp_delete_user($user->ID);

        wp_redirect(
            get_home_url()
        );
    }

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

        // récupération de la fiche profil du user connecté
        //? rappel : lors de l'inscritpion je vais générer une fiche profil qui sera associé au user
        // attention, pour l'instant le mecanisme 
        // ne vas marcher que pour les 'developers'
        $profile = $this->getProfile($user);
        //var_dump($profile->post_title);die();

        // je fabrique une petite boite pour transmettre des données a la vue
        $petiteBoite = [
            // dans cette petite boite je fabrique un "tirroir" currentUser
            'currentUser' => $user,
            'profile' => $profile
        ];


        $this->show('views/user/home', $petiteBoite);
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
        $petiteBoite = [
            'info1' => 'blabla info1'
        ];

        $this->show('views/user/hello', $petiteBoite);
    }
}
