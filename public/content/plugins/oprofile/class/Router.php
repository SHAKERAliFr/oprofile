<?php

namespace OProfile;

class Router
{

    public function __construct()
    {
        add_action(
            'init',
            [$this, 'registerRoutes']
        );
    }

    /**
     * registerRoutes
     * 
     * Ici je vais écouter les URL pour vérifer si je ne 
     * capte pas un /user/quelquechose
     * 
     * Si c'est cas, je vais passer une vraible GET dans l'url qui va me servir pour la suite de la procédure
     *
     * @return void
     */
    public function registerRoutes()
    {
        //! ETAPE 1 : on surveille l'URL
        // DOC WP PLUGIN Custom route https://developer.wordpress.org/reference/functions/add_rewrite_rule/
        add_rewrite_rule(
            // regexp de validation de l'url demandée par le visiteur
            // lorsque dans l'url il y aura la chaine "user" suivi d'un "/" optionnnel, suivi de n'importe quoi
            // exemple /user/home ou encore /user/delete
            'user/?.*',
            // on définit une variable "VIRTUELLE" "$_GET" qui va nous permettre de savoir quand notre systeme de routing va prendre le relais
            'index.php?cestNousMemeQuOnVaGererLaRoute=true',
            // la règle va se mettre en haut de la pile de priorité (donc sera prioritaire)
            'top'
        );

        add_rewrite_rule(
            // regexp de validation de l'url demandée par le visiteur
            // lorsque dans l'url il y aura la chaine "user" suivi d'un "/" optionnnel, suivi de n'importe quoi
            // exemple /user/home ou encore /user/delete
            'tatayoyo/?.*',
            // on définit une variable "VIRTUELLE" "$_GET" qui va nous permettre de savoir quand notre systeme de routing va prendre le relais
            'index.php?tatayoyo=true',
            // la règle va se mettre en haut de la pile de priorité (donc sera prioritaire)
            'top'
        );

        add_rewrite_rule(
            // regexp de validation de l'url demandée par le visiteur
            // lorsque dans l'url il y aura la chaine "user" suivi d'un "/" optionnnel, suivi de n'importe quoi
            // exemple /user/home ou encore /user/delete
            'mikabuche/?.*',
            // on définit une variable "VIRTUELLE" "$_GET" qui va nous permettre de savoir quand notre systeme de routing va prendre le relais
            'index.php?mikabuche=true',
            // la règle va se mettre en haut de la pile de priorité (donc sera prioritaire)
            'top'
        );
        add_rewrite_rule(
            // regexp de validation de l'url demandée par le visiteur
            // lorsque dans l'url il y aura la chaine "user" suivi d'un "/" optionnnel, suivi de n'importe quoi
            // exemple /user/home ou encore /user/delete
            'test/?.*',
            // on définit une variable "VIRTUELLE" "$_GET" qui va nous permettre de savoir quand notre systeme de routing va prendre le relais
            'index.php?test=true',
            // la règle va se mettre en haut de la pile de priorité (donc sera prioritaire)
            'top'
        );

        //! ETAPE 2 : rafraichissement du cache des règles de routing WP
        // WP enrgistre les routes en BDD, d'ou la nécéssité de rafraichir ces routes
        //? ATTENTION, faire un flush des routes de cette manière est mauvais pour les performances.
        flush_rewrite_rules();


        //! ETAPE 3 : On demande a wordpress de surveiller certaines variables
        add_filter('query_vars', function ($query_vars) {
            $query_vars[] = 'cestNousMemeQuOnVaGererLaRoute';
            $query_vars[] = 'tatayoyo';
            $query_vars[] = 'mikabuche';
            $query_vars[] = 'test';
            //var_dump($query_vars);die();
            return $query_vars;
        });


        //! ETAPE 4 : Vérification, est ce qu'une route custom a été détectée

        add_filter('template_include', function ($template) {
            //var_dump($template);die();
            //récupération de la variable "virtuelle" cestNousMemeQuOnVaGererLaRoute
            // en temps normal je pourrais faire :
            //$customRoute = filter_input(INPUT_GET, 'cestNousMemeQuOnVaGererLaRoute')
            $cestNousMemeQuOnVaGererLaRoute = get_query_var('cestNousMemeQuOnVaGererLaRoute');
            $tatayoyo = get_query_var('tatayoyo');
            $mikabuche = get_query_var('mikabuche');
            $test = get_query_var('test');

            if ($mikabuche) {
                echo "On charge mikabuche.php";
                die;
            }

            if ($tatayoyo) {
                echo "On charge tatayoyo.php";
                die;
            }

            if ($cestNousMemeQuOnVaGererLaRoute || $test) {
                return __DIR__ . '/../custom-routes.php';
            }

            return $template;
        });
    }
}
