<?php
//  Déclaration du plugin
/**
 * Plugin Name: OProfile 
 * Author: Xandar team
 *  Description: Découverte plugs WP
 */

use OProfile\Plugin;

require __DIR__ . '/vendor-oprofile/autoload.php';
// instanciation du plugin (classe principale)
$oProfile = new Plugin();



// activation "hook" https://developer.wordpress.org/reference/functions/register_activation_hook/
register_activation_hook(
    // premier argument, le chemin vers le fichier de déclaration du plugin
    __FILE__,
    // Deuxieme argument, je vais indiquer la methode a executer sur l'objet $oProfile
    [$oProfile, 'activate']

);

register_deactivation_hook(
    __FILE__,
    [$oProfile, 'deactivate']
);
