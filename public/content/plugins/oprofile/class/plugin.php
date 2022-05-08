<?php

namespace OProfile;

class Plugin
{
    public function __construct()
    {
        // Dans ce constructeur je vais venir fabriquer mes premiers CPT :D !! 
        // au moment de l'initialisation de Wordpress
        add_action(
            'init',
            [$this, 'createProjectCustomPostType']
        );

        add_action(
            'init',
            [$this, 'createCustomerProfileCustomPostType']
        );

        add_action(
            'init',
            [$this, 'createDeveloperProfileCustomPostType']
        );

        add_action(
            'init',
            [$this, 'createTechnologyCustomTaxonomie']
        );

        add_action(
            'init',
            [$this, 'createActivitySectorTaxonomie']
        );

        add_action(
            'init',
            [$this, 'createSkillCustomTaxonomie']
        );
    }
    /**
     * createProjectCustomPostType
     * Fabrication de notre tout premier CPT (Custom Post Type) !! 
     * @return void
     */
    public function createProjectCustomPostType()
    {
        register_post_type(
            // identifiant du post type
            'project',
            // les options pour configurer le post type
            [   // intitulé
                'label' => 'Project',
                'public' => true,
                'hierarchical' => false,
                'menu_icon' => 'dashicons-admin-tools',
                'supports' => [
                    'title',
                    'thumbnail',
                    'editor'
                ],
                'capability_type' => 'project',
                'map_meta_cap' => true
            ]
        );
    }

    public function createDeveloperProfileCustomPostType()
    {
        register_post_type(
            // identifiant du post type
            'developer-profile',
            // les options pour configurer le post type
            [   // intitulé
                'label' => 'Developer Profile',
                'public' => true,
                'hierarchical' => false,
                'menu_icon' => 'dashicons-admin-users',
                // fonctionnalités activable poure un cpt :  ‘title’, ‘editor’, ‘comments’, ‘revisions’, ‘trackbacks’, ‘author’, ‘excerpt’, ‘page-attributes’, ‘thumbnail’, ‘custom-fields’, and ‘post-formats’.
                'supports' => [
                    'author',
                    'title',
                    'thumbnail',
                    'editor'
                ],
                'capability_type' => 'developer',
                'map_meta_cap' => true
            ]
        );
    }

    public function createCustomerProfileCustomPostType()
    {
        register_post_type(
            // identifiant du post type
            'customer-profile',
            // les options pour configurer le post type
            [   // intitulé
                'label' => 'Customer Profile',
                'public' => true,
                'hierarchical' => false,
                'menu_icon' => 'dashicons-admin-users',
                // fonctionnalités activable poure un cpt :  ‘title’, ‘editor’, ‘comments’, ‘revisions’, ‘trackbacks’, ‘author’, ‘excerpt’, ‘page-attributes’, ‘thumbnail’, ‘custom-fields’, and ‘post-formats’.
                'supports' => [
                    'title',
                    'thumbnail',
                    'editor'
                ],
                'capability_type' => 'customer', //! pour customizer les capability par defaut wp
                'map_meta_cap' => true //!ajouter plus de capability 
            ]
        );
    }
    /**
     * createTechnologyCustomTaxonomie
     * Fabrication de notre premiere CT (custom Taxo) (étiquette maison)
     * @return void
     */
    public function createTechnologyCustomTaxonomie()
    {
        register_taxonomy(
            //identifiant taxonomie 
            'technology',
            // cette "étiquette" pourra etre utilisé sur le CPT project
            ['project', 'developer-profile'],
            // tableau d'options
            [
                'label' => 'Technologie',
                'hierarchical' => true,
                'public' => true
            ]
        );
    }

    public function createSkillCustomTaxonomie()
    {
        register_taxonomy(
            //identifiant taxonomie 
            'skill',
            // cette "étiquette" pourra etre utilisé sur le CPT project
            ['developer-profile'],
            // tableau d'options
            [
                'label' => 'Compétence',
                'hierarchical' => false,
                'public' => true
            ]
        );
    }

    public function createActivitySectorTaxonomie()
    {
        register_taxonomy(
            //identifiant taxonomie 
            'activity-sector',
            // cette "étiquette" pourra etre utilisé sur le CPT project
            ['customer-profile'],
            // tableau d'options
            [
                'label' => 'Secteur d\'activité',
                'hierarchical' => false,
                'public' => true
            ]
        );
    }
    /**
     * activate
     * Methode executée lors de l'activation du plugin
     * @return void
     */
    public function activate()
    {
        // Pour la création de roles custom
        // il faut IMPERATIVEMENT que je me place dans 
        // l'activation du plugin, et que je retire le role
        // lors de la désactivation du plugin
        $this->registerDeveloperRole();
        $this->registerCustomerRole();
        $this->addCapAdmin(
            [
                'project',
                'customer',
                'developer'
            ]
        );
    }

    public function registerDeveloperRole()
    {
        // add_role https://developer.wordpress.org/reference/functions/add_role/

        add_role(
            // identifiant du role 
            'developer',
            // libellé
            'Developpeur',
            // liste des autorisatrions
            [
                'delete_developers' => false,
                'delete_others_developers' => false,
                'delete_private_developers' => false,
                'delete_published_developers' => false,
                'edit_developers' => true,
                'edit_others_developers' => false,
                'edit_private_developers' => false,
                'edit_published_developers' => true,
                'publish_developers' => false,
                'read_private_developers' => false
            ]
        );
    }
    public function registerCustomerRole()
    {
        add_role(
            // identifiant du role 
            'customer',
            // libellé
            'Client',
            // liste des autorisatrions
            [
                'delete_customers' => false,
                'delete_others_customers' => false,
                'delete_private_customers' => false,
                'delete_published_customers' => false,
                'edit_customers' => true,
                'edit_others_customers' => false,
                'edit_private_customers' => false,
                'edit_published_customers' => true,
                'publish_customers' => false,
                'read_private_customers' => false,
            ]
        );
    }

    /**
     * deactivate
     * Methode executée lors de la désactivation d'un plugin
     * @return void
     */
    public function deactivate()
    {
        // //! ATTENTION ne pas oublier de supprimer les rôles lors de la désactivation du plugin
        remove_role('developer');
        remove_role('customer');
    }
    public function addCapAdmin($customCapArray)
    {
        // methode qui nous permet d'ajouter les droits sur les CPT  pour le role administrateur
        //! Attention, sans cette opération les CPT recipe vont disparaitre
        //! en effet, nous avons définis un "capability_type" pour ce dernier
        //! et l'adminstrateur ne vas pas avoir automatiquement les droits 
        // il est possible d'intéragir avec les roles et capabilities en dehors de la création des roles a l'aide des deux fonctions suivante :
        // je peux récupérer un role WP sous la forme d'un objet grace fonction WP get_role()
        $role = get_role('administrator');
        foreach ($customCapArray as $customCap) {
            // grace a la methode add_cap de cet objet qui représente le role, je peux ajouter des droits a ce dernier
            $role->add_cap('delete_others_' . $customCap . 's');
            $role->add_cap('delete_private_' . $customCap . 's');
            $role->add_cap('delete_' . $customCap . 's');
            $role->add_cap('delete_published_' . $customCap . 's');
            $role->add_cap('edit_others_' . $customCap . 's');
            $role->add_cap('edit_private_' . $customCap . 's');
            $role->add_cap('edit_' . $customCap . 's');
            $role->add_cap('edit_published_' . $customCap . 's');
            $role->add_cap('publish_' . $customCap . 's');
            $role->add_cap('read_private_' . $customCap . 's');
        }
    }
}
