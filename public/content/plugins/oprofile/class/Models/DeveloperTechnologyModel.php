<?php

namespace OProfile\Models;

class DeveloperTechnologyModel extends CoreModel
{

    public function createTable()
    {
        $sql = "
            CREATE TABLE `developer_technology` (
                `id` bigint(24) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `level` tinyint(4) unsigned NOT NULL,
                `developer_id` bigint(24) unsigned NOT NULL,
                `technology_id` bigint(24) unsigned NOT NULL,
                `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                `updated_at` datetime NULL
            );
        ";

        // pour pouvoir créer la table, WP nous donne une fonction qui va nous permettre de créer la table
        // https://developer.wordpress.org/reference/functions/dbdelta/

        //! Attention, tout comme pour la fonction wp_delete_user, il va nous falloir faire un require pour pouvoir bénéficier de cette fonction dbDelta
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql); //!method wp permettant anteragir avec la bdd pour creer une table 
    }

    public function dropTable()
    {
        $sql = 'DROP TABLE `developer_technology`';
        // $this->database = objet $wpdb que j'ai récupéré grace a mon CoreModel
        $this->database->query($sql);
    }

    public function insert($developerId, $technologyId, $level = 0)
    {
        $data = [
            'developer_id' => $developerId,
            'technology_id' => $technologyId,
            'level' => $level,
            'created_at' => date('Y-m-d H:i:s')
        ];
        //!Grace a la methode insert de $wpdb
        //! je peux réaliser une insertion en BDD
        //! sans requete SQL, seulement grace a un tableau associatif qui contient les données de mon insert
        $this->database->insert('developer_technology', $data);
    }

    public function delete($id)
    {
        $where = [
            'id' => $id
        ];

        $this->database->delete('developer_technology', $where);
    }

    public function update($id, $technologyId, $level)
    {
        $data = [
            'technology_id' => $technologyId,
            'level' => $level,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $where = [
            'id' => $id
        ];

        $this->database->update(
            'developer_technology',
            $data,
            $where
        );
    }

    public function getTechnologyByUserId($userId)
    {

        // IMPORTANT pour faire des requêtes préparées, il faut passer les paramètre dans leur ordre d'apparition dans la requête. Il faut utiliser la syntaxe sprintf pour spécifier le type des paramètre

        /*
        %d : type entier
        %s : type string
        */

        $sql = "
            SELECT
                *
            FROM `developer_technology`
            WHERE
                developer_id = %d
        ";

        // ci dessus l'équivalent du "token" que l'on a vu en S06 est le '%d'

        // je viens utiliser la methode executePreparedStatement quej e retrouve dans le CoreModel et qui va me permettre de faire une requete préparée
        $rows = $this->executePreparedStatement(
            $sql,
            [
                $userId, // etant donné que le premier "token" %d se situe au niveau de la condition WHERE developer_id = %d, Je précise ici a quoi va correspondre ce token ! 
                //Attention si j'en avais plusieurs, il faudrait tout simplement renseigner ce a quoi ils correspondent ici en faisant attention a l'ordre d'apparition dans ma requete
            ]
        );

        $results = [];
        //todo IL NOUS FAUT IMPERATIVEMENT TERMINER CETTE METHODE

        foreach ($rows as $result) {
            // a partir de l'id des technolgy, je viens récupérer l'objet term correspondant
            $technology = get_term($result->technology_id, 'technology');

            $finalResult[] = [
                'technology' => $technology,
                'level' => $result->level
            ];
        }


        return $finalResult;
    }
}
