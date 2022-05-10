<?php

namespace OProfile\Controllers;

class CoreController
{

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
        // var_dump($viewVars);
        // die();
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
            wp_redirect(
                wp_login_url()
            );
        }
    }
}
