<?php
echo '<section class="sectionHome">';
//! recuperation des donneés depuis custom table
get_header();
// var_dump($args);
$currentUser = $args['currentUser']->display_name;
$technologyArray = $args['taxoData'];
$level = $args['taxoData'][0]['level'];

echo '<h1 class="nicename">' . $currentUser . '</h1>';
// var_dump($technologyArray);
echo '<h2 style="font-size:1.3rem; margin-top:15px;">Tech: </h2><br>';
echo '<ul>';
foreach ($technologyArray as $technologyObject) {

    echo '<li style="font-size:1.3rem; color:white">' . $technologyObject['technology']->name .
        ' : ( niveau de maitrise' . $technologyObject['level'] . ' )</li>';
}
echo '</ul>';
$router = $args['router'];
$deleteUrl = $router->generate('user-delete');

echo "<a href=\"$deleteUrl\"class=\"button\" > Supprimer le compte </a>";
echo '</section>';
get_footer();

die;





//!recuperation des donneés depuis cpt fiche profile
get_header();

echo '<section class="section">';

echo '<h1 class="nicename">' . $currentUser->data->user_nicename . '</h1>';
// récupération des compétences associés au profil utilisateur
// (récupération des "etiquettes" 'skill' sur la fiche profil)
$skills = wp_get_object_terms(
    $profile->ID,
    'skill'
);
// récupération des technologies associés au profil utilisateur
// (récupération des "etiquettes" 'technology' sur la fiche profil)
$technologies = wp_get_object_terms(
    $profile->ID,
    'technology'
);



//var_dump($skills);
echo '<h2 style="font-size:1.3rem;">Compétences : </h2><br>';
echo '<ul style="font-size:1.3rem; color:white">';
foreach ($skills as $skill) {
    echo '<li>' . $skill->name . '</li>';
}
echo '</ul>';

echo '<h2 style="font-size:1.3rem; margin-top:15px;">Tech: </h2><br>';
echo '<ul>';
foreach ($technologies as $technology) {
    echo '<li style="font-size:1.3rem; color:white">' . $technology->name . '</li>';
}
echo '</ul>';

//! Correction challente supprimer compte
// Etape 1 je récupère le router dans ma vue
$router = $args['router'];
$deleteUrl = $router->generate('user-delete');

echo "<a href=\"$deleteUrl\"class=\"button\" > Supprimer le compte </a>";

echo '</section>';






get_footer();
