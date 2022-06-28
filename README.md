# Projet oProfile

## Objectif

oProfile est une plateforme d'échange entre développeurs et clients. Une partie communication sera également disponible sous le format blog.

## Organisation du projet

Nous allons suivre la méthodologie Agile Scrum.

## Choix techniques

### Frontend

Le UI / UX designer, en suivant la logique **Mobile First**, a déjà travaillé sur [les maquettes](./conception/integration/ui/README.md) et sur l'[expérience utilisateur](./conception/integration/ux/README.md).

Les outils que nous avons sélectionnés pour gérer les problématiques front-end sont :

- **Parcel** comme Bundler (organisation des fichiers, optimisation des assets, &hellip;)
- **Sass** pour l'intégration (en remplacement de CSS)
- **JavaScript** (sans librairies ni framework :muscle:) pour les intéractions

### Backend

WordPress est l'outil que nous avons choisi côté backend pour réaliser le projet, à la fois pour le front-office et le back-office.

Avec son système de thème, WordPress met a disposition énormément de fonctionnalités pour afficher et gérer les contenus sur un front-office.

En plus d'être une petite merveille d'UX, WordPress met également à disposition des développeurs un back-office avec une quantité incroyable de fonctionnalités :tada: :smirk:.

#### Base de données

Pour la manipulation des données, le [modèle conceptuel de données (MCD)](./conception/database/oprofile-mcd.svg) a déjà été créé par notre brillant architecte d'application :v:

Par contre, il a commencé à travailler sur [l'intégration de notre modèle de données dans celui de WordPress](./conception/database/README.md) mais il faudra qu'on finalise tout ça nous-même. Le [MCD de WordPress](./conception/database/wordpress-mcd.svg) et le [diagramme ERR de WordPress](./conception/database/wordpress-eer.png) sont disponibles dans le dossier des documents de conception.

En résumé, tous les documents sont disponibles dans [le dossier `conception/database`](./conception/database).
