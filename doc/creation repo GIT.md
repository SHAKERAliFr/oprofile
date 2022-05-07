# Créer un repo github

- Je fabrique un dossier en local (sur ma vm)
- Je fabrique un repo vide sur github (petit bouton vert "new" sur la page de l'orga (Oclock-Xandar))
- J'ouvre un VSC dans mon dossierr en local
- Je tape la commande suivante

```
git init
```

- Puis pour lier mon dossier local au repo guthub fraichement créé je dois taper la commande suivante :

```
git remote add origin lienSSHduRepoFraichementCreeSurGithub
```

- A partir de là, je peux coder, faire des
  git add & git commit
- et pour pusher mon travail sur le repo github il ne me reste plus qu'a faire :

```
git push
```

- Il est indiqué que le master n'existe pas sur le repo github, une commande est alors indiquée

```
git push --set-upstream origin master
```

- Il suffit alors de copier coller cette commande dans le terminal :)
- YAtaaaaa c'est terminé !
