- after_setup_theme : pour ajouter des options ou paramètrage de thèmes, typiquement pour ajouter des themes support avec add_theme_support
- init : très utilisé, notamment pour créer des CPT ou Taxonomy ou pour les plugins
- wp_enqueue_scripts : pour inclure des scripts ou styles pour le thème
- pre_get_posts : principalement pour modifier la query principale de WordPress. Par exemple ton fichier archive.php affiche peut être 10 articles par défaut. Tu pourrais si tu veux modifier la query grâce à ce hook pour afficher 15 articles, et que d'une certaine catégorie. Très puissant comme hook !
- template_redirect : dernier hook avant que le html commence à être affiché sur la page. Très utilisé pour traiter des formulaires ou faire des redirections, par exemple si la page nécessite qu'un utilisateur soir connecté et qu'il ne l'est pas.

By AlexisOclock
