<?php

namespace OProfile;

use WP_User;

class Registration
{

    public function __construct()
    {
        //todo Etape 1 : Customization du formulaire
        add_action(
            'register_form',
            [$this, 'customizeForm']
        );

        //todo Etape 2 : Customization du controle des données
        // je vais reçevoir des données, et je devrais les return, j'utilise donc un add_filter

        add_filter(
            'registration_errors',
            [$this, 'checkRegistration'],
            10, //  priorité du hook (10 est une valeur par défaut)
            3 // dans la méthode checkRegistration, je vais récupérer 3 arguments (Un objet erreur, le login et l'email)
        );

        //todo dernière etape : Customization de l'enregistrement d'un utilisateur
        add_filter(
            'user_register',
            [$this, 'customUserRegistration'],
            10,
            1
        );
    }

    public function customizeForm()
    {
        $customFields = '
            <p>
                <label for="user_password">Password</label>
                <input type="text" name="user_password" id="user_password" class="input" value="" size="20" autocapitalize="off">
            </p>
            <p>
                <label>Vous êtes : </label>
                <div>
                    <label>
                        <input type="radio" name="user_role" value="customer" /> Une entreprise
                    </label>
                    <label>
                        <input type="radio" name="user_role" value="developer" /> Un(e) developpeur(se)
                    </label>
                </div>
            </p>
        ';

        echo $customFields;
    }

    // Ici checkRegistration va recevoir au max 3 parametres (on se rapelle que par defaut, le formulaire d'inscription ne contient que deux inputs : login et l'email je vais donc recevoir ces deux données + un objet Errors qui me permettra la gesion des erreurs )
    public function checkRegistration($errors, $login, $email)
    {
        // récupération du role choisi par l'utilisateur
        $role = filter_input(INPUT_POST, 'user_role');
        if (!$role) {
            $errors->add(
                // identifiant de l'erreur
                'user_role_empty',
                // message d'erreur
                'Vous devez choisir un rôle'
            );
        }

        $password = filter_input(INPUT_POST, 'user_password');
        // j'imagine une methode qui va me permettre de faire la vérification du champs password
        if (!$this->checkPassword($password)) {
            // Si il ya un pépin
            $errors->add(
                // identifiant de l'erreur
                'user_password_invalid',
                // message d'erreur
                'Votre mot de passe n\'est pas valide'
            );
        }
        //! ATTENTION A NE PAS OUBLIER LE RETURN, JE SUIS SUR UNE FONCTION LIEE A UN HOOK PAR UN ADD_FILTER (ce qui sous-entends qu'il sera nécessaire de faire un return)
        return $errors;
    }


    public function checkPassword($password)
    {
        // un mot de passe doit faire 8 caractère de long
        // un mot de passe doit avoir des minuscules + majuscules
        // un mot de passe doit avoir un chiffre
        // un mot de passe doit avoir un caractère spécial

        // controle de la longueur
        if (mb_strlen($password) < 8) {
            return false;
        }

        // vérification qu'il y a au moins une minuscule dans le mdp
        if (!preg_match('/[a-z]+/', $password)) {
            return false;
        }

        // vérification qu'il y a au moins une majuscule dans le mdp
        if (!preg_match('/[A-Z]+/', $password)) {
            return false;
        }

        // vérification qu'il y a au moins un chiffre dans le mdp
        if (!preg_match('/[0-9]+/', $password)) {
            return false;
        }

        // TIPS REGEX vérification est ce qu'il y au moins un caratère spécial dans le mdp
        // \W signifie tout ce qui n'est pas une lettre (majuscule ou minuscule) et n'est pas un chiffre
        // \w  signifie tout ce est une lettre (majuscule ou minuscule) ou n'est pas un chiffre
        /*
        if(!preg_match('/\W/', $password)) {
            return false;
        }
        */

        return true;
    }

    public function customUserRegistration($userId)
    {
        // récupération de l'utilisateur qui vient d'être créé (sous la forme d'un objet)
        // et je viens pour ce faire, utiliser une classe Wordpress : WP_User
        $userObject = new WP_User($userId);
        // par défaut, l'utilisateur va avoir le role subscriber qu'il nous faut supprimer
        $userObject->remove_role('subscriber');

        // enregistrement du mot de passe utilisateur
        $passord = filter_input(INPUT_POST, 'user_password');
        //fonction wp qui permet de définir un mot de passe pour un user
        wp_set_password($passord, $userId);

        // récupération role choisi par l'utilisateur
        $choosedRole = filter_input(INPUT_POST, 'user_role');

        //var_dump($choosedRole);die();

        // ici sécurité, j'empeche des petits malins d'éventuellement changer la value des radio butons  (je vérifie que le role séléctionné est bien developer OU user_role et c'est TOUT)
        if ($choosedRole === 'developer' || $choosedRole === 'customer') {
            // nous ajoutons le rôle choisi par l'utilisateur
            $userObject->add_role($choosedRole);
        }

        //! CHALLENGE
        if ($choosedRole === 'developer') {
            // DOC WP CINSERT POST : https://developer.wordpress.org/reference/functions/wp_insert_post/
            wp_insert_post([
                'post_author' => $userId,
                'post_status' => 'publish',
                'post_title' => 'DevProfile',
                'post_type' => 'developer-profile'
            ]);
        }
        //! FIN CHALLENGE


    }
}
