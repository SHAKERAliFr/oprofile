# Rappel procédure de travail

1 / Le premier jour je clone le repo généré grace a Kourou

2 / Chaque début de nouvelle journée je fabrique une branche dans laquelle je vais pouvoir livecoder (exemple e1-monPrenom)

```
git checkout -b e1-monPrenom
```

3/ La journée je peux live coder SUR MA BRANCHE et faire des 

```
git add .
git commit -m "explication modifs"
```
Pour enregistrer tout mon code sur ma branche

4/ en fin de journée je vérifie que toute mes modifications ont bien étés "accrochés" à la branche que j'ai fabriqué

```
git status 
```

Si des modifications ont été oubliés :
```
git add . 
git commit -m "descriptif"
```

5/ je retourne sur le master
```
git checkout master
```

6/ Je récupère la branche du prof en faisant la commande suivante dans le termial (a la racine de notre projet)

```
sh import-external-repo.sh lienSSHRepoProf nomDeLaCopieQueJeVaisAvoirSurMonRepo nomDeLaBrancheARecuperer
```

Exemple d'utilisation

```
sh import-external-repo.sh git@github.com:O-clock-Xandar/S05-projet-oShop-olivier-oclock.git e03-prof e3-routage
```
sh import-external-repo.sh : lancer le script

git@github.com:O-clock-Trinity/wp-oProfile-MikaSlayki.git : lien ssh du repo prof

e03-routage : la branche du prof a récupérer ...

e03-prof : ... qui va etre copiée sur mon repo en tant que "e03-prof"