# Introduction


## Un grand merci à tou.te.s!

>Tout d'abord, merci d'avoir envisagé de contribuer à SWAPP. Ce sont des gens comme vous qui font de SWAPP un outil formidable. 

### Pourquoi prendre connaissance de nos directives ?  

> Suivre ces directives permet de montrer que vous respectez le temps des développeurs qui gèrent et développent ce projet open source. En retour, ils vous rendront la pareille en traitant votre problème, en évaluant les changements et en vous aidant à finaliser vos pull requests.  
> Comme pour tout le reste du projet, les contributions à SWAPP sont régies par notre [Code de conduite](http://SWAPP/code-of-conduct/).  

### Les types de contribution que nous recherchons :

> SWAPP est un projet open source et nous aimons recevoir des contributions de notre communauté - vous! Il existe de nombreuses façons de contribuer, de la rédaction de tutoriels ou d'articles de blog, à l'amélioration de la documentation, à la soumission de rapports de bugs et de demandes de fonctionnalités ou à l'écriture de code qui peut être incorporé dans SWAPP lui-même.

### Les types de contribution que nous NE recherchons PAS :

> Veuillez ne pas utiliser l'outil issue tracker pour les questions de support. Vérifiez si d'autre moyen tel que Google peuvent vous aider à résoudre votre problème. Stack Overflow mérite également d'être pris en compte.

# Règles de base

## Nos attentes en termes de comportement :

> * Responsabilité 
> * Assurer la compatibilité multiplateforme pour chaque changement accepté. Windows, Mac, Debian et Ubuntu Linux.
> * Créez des issues pour les modifications et améliorations majeures que vous souhaitez apporter. Discutez des choses de manière transparente et obtenez les retours de la communauté.
> * N'ajoutez aucune classe à la base de code à moins que cela ne soit absolument nécessaire. Err du côté de l'utilisation des fonctions.
> * Gardez les versions de fonctionnalités aussi petites que possible, de préférence une nouvelle fonctionnalité par version.
> * Soyez accueillant envers les nouveaux arrivants et encouragez divers nouveaux contributeurs de tous horizons. Consultez le [Code de conduite de la communauté SWAPP](https://SWAPP/link/).


## Issues tracker :

Tout d'abord: **Ne signalez PAS les vulnérabilités de sécurité dans les problèmes publics!**  
Veuillez le divulguer de manière responsable en informant [l'équipe SWAPP](mailto: team@.com? Subject = Security).  
Nous évaluerons le problème dans les meilleurs délais et vous donnerons une estimation du moment où nous aurons un correctif et une version disponibles pour une éventuelle divulgation publique.

L'outil issue tracker est le moyen à priviligier pour les [bug reports](#bugs),
[features requests](#features) et [pull requests](#pull-requests), mais veillez à observer les restrictions suivantes :

* Veuillez **ne pas** utiliser l'outil issue tracker pour les demandes d'assistance personnelle. Adressez-vous plutôt à [l'équipe SWAPP](mailto: team@.com? Subject = Support).

* Veuillez également **ne pas** vous éloigner du sujet ou troller les issues. Gardez la discussion sur le sujet et veillez à respecter les opinions des autres.


## Bugs reports :

Un bug est un problème _démontrable_ causé par le code du répertoire.
Les bons rapports de bugs sont extrêmement utiles - merci de suivre ici aussi nos directives!

Directives pour les rapports de bugs :

1. **Utilisez la recherche d'issues de GitHub** &mdash; vérifier si le problème a déjà été signalé.

2. **Vérifiez si le problème a été résolu** &mdash; essayez de le reproduire en utilisant la dernière branch `master` ou `next` du répertoire.

3. **Isolez le problème** &mdash; créer idéalement un cas de test réduit.

Un bon rapport de bogue ne devrait pas laisser les autres avoir besoin de vous poursuivre pour plus d'informations.  
Veuillez essayer d'être aussi détaillé que possible dans votre rapport.   
Quel est votre environnement ? Quelles étapes reproduiront le problème ? Quel OS expérimente le problème ? À quoi vous attendriez-vous ?  
Tous ces détails aideront personnes pour corriger les bugs potentiels.  

Exemple:

> Titre de rapport de bug court et descriptif
>
> Un résumé du problème et de l'environnement du navigateur / du système d'exploitation dans lequel il se produit. Le cas échéant, incluez les étapes nécessaires pour reproduire le bug.
>
> 1. Ceci est le premier pas 
> 2. Ceci est le second pas 
> 3. Autres étapes, etc. 
>
> `<url>` - un lien vers le test de cas réduit 
>
> Toute autre information que vous souhaitez partager en rapport avec le problème
> signalé. Cela peut inclure les lignes de code que vous avez identifiées comme
> à l'origine du bug, et des solutions potentielles (et vos opinions sur leur
> mérite).


## Feature Requests :

Les demandes de fonctionnalités sont les bienvenues. Mais prenez toutefois un moment pour savoir si votre idée correspond à la portée et aux objectifs du projet.  
C'est à *vous* de convaincre les développeurs du projet des mérites de cette fonctionnalité. 
Veuillez s'il vous plaît fournir autant de détails et de contexte que possible. 


## Pull Requests :

Les pull requests - correctifs, améliorations, nouvelles fonctionnalités - sont d'une aide fantastique. Ils doivent cependant rester concentrés dans leur portée et éviter de contenir des commits non liés. Veuillez d'abord demander avant de vous lancer dans une pull request importante (par exemple, implémentation de fonctionnalités, refactorisation de code), sinon vous risquez de passer beaucoup de temps à travailler sur quelque chose que les développeurs du projet pourraient ne pas vouloir fusionner dans le projet. 

### Pour votre première contribution

> Vous ne savez pas par où commencer à contribuer à SWAPP ? Vous pouvez commencer par examiner ces problèmes pour les débutants et les demandes d'aide :
> Problèmes pour débutants - problèmes qui ne devraient nécessiter que quelques lignes de code et un test ou deux.
> Problèmes de recherche d'aide - problèmes qui devraient être un peu plus complexes que les problèmes de débutant.
> Les deux listes de problèmes sont triées par nombre total de commentaires. Bien qu'il ne soit pas parfait, le nombre de commentaires est une approximation raisonnable de l'impact qu'un changement donné aura.

> Si vous n'avez jamais créé de pull request auparavant, bienvenue :smile: Vous pouvez apprendre comment faire grâce à cette série de tutoriels *gratuits*, [How to Contribute to an Open Source Project on GitHub](https://egghead.io/series/how-to-contribute-to-an-open-source-project-on-github).

1. [Fork](http://help.github.com/fork-a-repo/) le projet, clone votre fork, et configurez les remotes :

   ```bash
   # Clonez votre fork du repo dans le répertoire courant
   git clone https://github.com/<your-username>/<repo-name>
   # Accédez au répertoire nouvellement cloné
   cd <repo-name>
   # Attribuez le dépôt d'origine à une remote appelée «upstream»
   git remote add upstream https://github.com/swapp/<repo-name>
   ```

2. Si vous avez cloné il y a quelque temps, récupérez les dernières modifications sur la master :

   ```bash
   git checkout master
   git pull upstream master
   ```

3. Créez une nouvelle branche de rubrique (hors de la branche principale de développement de projet) pour contenir votre fonctionnalité, modifier ou corriger :

   ```bash
   git checkout -b <topic-branch-name>
   ```

4. Assurez-vous de mettre à jour ou d'ajouter aux tests le cas échéant. Les correctifs et fonctionnalités ne seront pas acceptés sans tests.

5. Si vous avez ajouté ou modifié une fonctionnalité, assurez-vous de la documenter en conséquence dans le fichier `README.md`.

6. Poussez votre branch dans votre fork :

   ```bash
   git push origin <topic-branch-name>
   ```

7. [Ouvrez une Pull Request](https://help.github.com/articles/using-pull-requests/) avec un titre et une description clairs.

> À ce stade, vous êtes prêt à apporter vos modifications ! N'hésitez pas à demander de l'aide : tout le monde est débutant au début :smile_cat:

> PS : si un responsable vous demande de "rebaser" votre PR, il vous dit que beaucoup de code a changé et que vous devez mettre à jour votre branche pour qu'il soit plus facile de fusionner ;)


### Pour les membres de l'équipe des contributeurs SWAPP


1. Cloner le dépôt et créer une branche  

   ```bash
   git clone https://github.com/swapp/<repo-name>
   cd <repo-name>
   git checkout -b <topic-branch-name>
   ```

2. Assurez-vous de mettre à jour ou d'ajouter aux tests le cas échéant. Les correctifs et fonctionnalités ne seront pas acceptés sans tests.

3. Si vous avez ajouté ou modifié une fonctionnalité, assurez-vous de la documenter en conséquence dans le fichier `README.md`.

4. Poussez votre branche dans notre repo

   ```bash
   git push origin <topic-branch-name>
   ```

5. Ouvrez une Pull Request en utilisant votre branche avec un titre et une description clairs.

Optionnellement, vous pouvez nous aider avec cette marche à suivre. Mais ne vous inquietez  pas si c'est trop compliqué, nous pouvons vous aider et vous apprendre au fur et à mesure :)

#### Convention des Messages des Commit :

   - Commit fichiers de tests préfixés avec `test: ...` ou `test(scope): ...`
   - Commit corrections de bugs préfixés avec `fix: ...` or `fix(scope): ...`
   - Commit nouvelles fonctionnalités préfixés avec `feat: ...` or `feat(scope): ...`
   - Commit changements dans `package.json`, `.gitignore` et autres fichiers méta préfixés avec `chore(filename without ext): ...`
   - Commit modifications des fichiers README ou commentaires préfixés avec `docs: ...`
   - Commit changements de style préfixés avec `style: standard`

### Explain your preferred style for code, if you have any.

**IMPORTANT**: En soumettant un correctif, vous acceptez de concéder une licence pour votre travail sous la
même licence que celle utilisée par le projet.


# Community

L'équipe principale du projet se trouve dans la section [Team](TEAM.md).


# Soutenez ce projet !

Ce projet est géré par des bénévoles. Vous avez la possibilité de soutenir ce projet en faisant un don sur [SWAPP](http://SWAPP/). Votre aide est précieuse, merci du fond du :heart: !


# Code de conduite

Toutes les personnes qui interagissent dans les bases de code, issue trackers, les discussions et les listes de diffusion du projet SWAPP sont priées de suivre le [Code de conduite de la communauté SWAPP](https://SWAPP/link/).
