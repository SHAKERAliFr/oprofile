<?php
get_header();

$currentUser = $args['current_user'];
$profile = $args['fich_profile'];

var_dump($profile);
die();

echo '<section>';

echo '<h1>' . $currentUser->data->user_nicename . '</h1>';
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
echo 'Compétences : <br>';
echo '<ul>';
foreach ($skills as $skill) {
    echo '<li>' . $skill->name . '</li>';
}
echo '</ul>';

echo 'Tech: <br>';
echo '<ul>';
foreach ($technologies as $technology) {
    echo '<li>' . $technology->name . '</li>';
}
echo '</ul>';


echo '</section>';






get_footer();
