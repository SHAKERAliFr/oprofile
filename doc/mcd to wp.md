# Conversion d'un mcd vers une architecture WP

## Entité technologie :

- Type wordpress : taxonomie (catégorie - hiérarchique)
- Champs :
  - "name"
  - "logo" : term_meta

## Entité Développeur :

- Type wordpress : User (role dev)
- Champs :
  - Nom : users.user_nicename
  - Prenom : users.user_nicename
  - Pseudo : users.display_name
  - Email : users.user_email
  - Biographie : users*meta*
  - URLSite : users.user_url
  - URLGithub : users meta

## Entité Projet

- Type wordpress : Post
- Champs :
  - Nom : posts.post_title
  - Description : posts.post_content
  - URL : posts meta

## Entité Client

- Type wordpress : User (user role Client)
- Champs
  - Nom : users.user_nicename
  - Email : users.user_email
  - Biographie : users_meta
  - URLSite : users.user_url
  - URLGithub : users meta

## Entité Secteur d'activité

- Type wordpress : taxonomie (tag)
- Champs :
  - "nom" : "name" de la categorie

## Entité Compétence

- Type wordpress : taxonomie (catégorie - hiérarchique)
- Champs :
  - "nom" : "name" de la catégorie
  - "Description" : term_taxonomy.description
  - "icone" : term metadata
