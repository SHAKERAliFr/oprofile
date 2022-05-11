<?php

namespace OProfile\Controllers;

class CoreController
{

    protected $petiteBoiteRouter;

    /**
     * constructeur
     * 
     * On rapelle que le constructeur du CoreController va s'executer pour toutes les pages ! 
     */
    public function __construct()
    {
        // récupération du routeur depuis "l'espace" (scope) global
        global $router;
        // pour pouvoir nous le mettre sous le coude dans une propriété router
        $this->petiteBoiteRouter = $router;
    }


    /**
     * show
     * 
     * Methode qui va permettre au Controllers 
     * D'afficher une vue
     * ATTENTION les vues sont rangés dans le dossier views
     * qui lui même est dans le dossier themes/oprofile
     * Et c'est pour cela que je peux utiliser la fonction get_template_part
     *
     * @param [type] $viewName
     * @param array $viewVars
     * @return void
     */
    protected function show($viewName, $viewVars = [])
    {
        // nous passons le router a la vue
        $viewVars['router'] = $this->petiteBoiteRouter;

        //https://developer.wordpress.org/reference/functions/get_template_part/
        echo get_template_part(
            $viewName,
            null, // le deuxieme arguement ne m'interesse pas, d'apres la doc sa valeur par defaut est null, du coup je met "null"
            $viewVars
        );
    }

    /**
     * mustBeConnected
     * 
     * On vient vérifier si le user est connecté
     * (peu importe son role ! )
     * Et si ce n'est pas le cas on va le rediriger
     * vers la page login
     *
     * @return void
     */
    protected function mustBeConnected()
    {
        // si l'utilisateur n'est pas connecté
        if (!is_user_logged_in()) {
            //echo "Je ne suis pas connecté";die();
            // on le redirige vers la page de login
            wp_redirect(
                wp_login_url()
            );
            return false;
        } else {
            return true;
        }
    }

    protected function isAdmin()
    {
        // Je récupère l'utilisateur connecté sous la forme d'un objet
        $user = wp_get_current_user();
        // je récupère par la suite un TABLEAU de roles
        $roles = $user->roles;

        // si dans ce tableau de roles je trouve 'administrator'
        if (in_array('administrator', $roles)) {
            return true;
        } else {
            return false;
        }
    }
}
