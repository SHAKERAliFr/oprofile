<?php

namespace OProfile;

class Plugin
{
    public function __construct()
    {
        // grace a la ligne suivante je viens me racorder a la classe registration ! 
        // ainsi, tout ce que j'aurais codé en plus dans le constructeur de ma classe Plugin
        // va se retrouver dans le constructeur de la classe Registration !
        // $registration = new Registration();

        // Dans ce constructeur je vais venir fabriquer mes premiers CPT :D !! 
        // au moment de l'initialisation de Wordpress
        add_action(
            'init',
            [$this, 'createProjectCustomPostType']
        );
        add_action(
            'init',
            [$this, 'createTechnologyCustomTaxonomie']
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
                // 'capability_type' => 'project',
                // 'map_meta_cap' => true
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
            'project',
            // tableau d'options
            [
                'label' => 'Technologie',
                'hierarchical' => true,
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
    }
    /**
     * deactivate
     * Methode executée lors de la désactivation d'un plugin
     * @return void
     */
    public function deactivate()
    {
    }
}
