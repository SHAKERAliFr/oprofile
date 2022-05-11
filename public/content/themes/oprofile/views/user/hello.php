<?php
get_header();

echo "Je suis dans la vue hello.php<br>";
echo "Et j'ai récupéré des données : ";
echo $args['info1'];
get_footer();
//! ATTENTION les données qui sont transmises a la vue
//! vont atterir dans cette dernière en tant que $args 
//! ET NON PAS $viewData !!! 
