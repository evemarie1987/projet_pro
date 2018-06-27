####### Principe du routing

Principe du routing : créer des URL virtuelle.

Url virtuelle = url qui ne correspond pas a l'architecture des fichiers sur le serveur.

	-> sert a avoir de meilleur URL
	-> parfait pour une architecture MVC

C'est très important d'avoir de bonnes et belles URL pour un site ou une app web sérieuse.
Ca veut dire jeter a la poubelle les : 
	
	monsite.com/index.php?article_id=57 

Et faire plutôt des : 

	monsite.com/read/article-sport.

Permet :

	+ meilleur référencement
	+ meilleur lisibilité
	+ permet de dév de maniére beaucoup plus efficasse

L'exemple des archives d'un blog est assez parlant : www.monblog.fr/archives/2014/06

On ne va pas faire un dossier pour chaque nouvelle année, chaque mois, avec un contrôleur s'occupant de ce mois et de cette année en question...


####### Framework concept

Le micro-framework va s'occuper de faire 3 choses importantes :

1. Déterminer quel contrôleur exécuter
2. Déterminer quelle méthode du contrôleur exécuter (en fonction de la requette HTTP)
	-> soit j'arrive sur la page de manière classic en GET (sert moi le formulaire)
	-> soit j'arrive sur la page en POST (process les données et redirige moi)
3. Déterminer quelle vue afficher si le contrôleur ne fait pas de redirection HTTP. (donc si j'arrive en GET)

Grace au routing du mini-framework L'URL est virtuelle à partir du fichier index.php à la racine du projet.
index.php suit le principe du design pattern front controller, comme la plupart des frameworks sur le marché.

Par exemple en tapant : index.php/user

Le contrôleur UserController est exécuté dans le dossier application/controllers/user/UserController.class.php
La vue affichée UserView suit le même principe à partir du dossier application/www
	-> demo dans le navigateur
		-> url/index.php/user
		-> url/index.php/coucou ... etc
		
Noter la transformation en PascalCase des noms des fichiers à partir de l'URL.


Le micro-framework s'occupe également de l'autoload de classes et de créer deux variables disponibles dans les vues :

- $requestUrl : Pointe vers l'URL du front controller : index.php
Utilisé pour créer des hyperliens vers des contrôleurs.
	-> $requestUrl : PHP_PRO/index.php

- $wwwUrl : Pointe vers l'URL du dossier www contenant les vues et les fichiers statiques
Utilisé pour charger CSS, images, fonts, JavaScript, etc...
	-> $wwwUrl : PHP_PRO/application/www


Le coeur du micro-framework se trouve dans FrontController.class.php
Il ne sert à rien de faire ouvrir les fichiers du dossier library aux élèves, les plus curieux le feront.
L'implémentation est écrite de manière à ce que le code des élèves ressemble à Symfony 2.
