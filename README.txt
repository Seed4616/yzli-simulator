# PROJET IZLY
***
##Présentation du Projet
Ce projet est conçu du cadre de l'UE Projet Base de Données/Réseau.
Le thème principal de notre projet est de simuler un paiement d'un client Izly dans une cantine de l'université.
##Installation
L'installation de notre programme demande l'accès d'environnement de travail utilisant PYTHON 3.9 et JAVA 17 avec l'import du fichier jar "postgresql-42.5.1" (contenue dans le repertoire jar).
Nos client peuvent également, via notre site, acceder à leur compte (ou le créé) afin de le recharger ou d'acceder à leurs informations.
[Lien vers notre site:](https://azure.alwaysdata.net/index.php)
##Amélioration
Pour rendre notre simulation plus intéressante les options suivantes pourrait être ajouté au projet:
1.Ajout sur le site d'une page Menu pour la cantine.
2.Ajout d'une modification de mot de passe.
3.Ajout des réponse du serveur vers le client.
4.Ajout de la fonctionnalité du choix de montant de rechargement sur le site.
5.Ajout de la facturation des menus spéciaux de la cantine.
##Utilisation Reseau
Avant de pouvoir envoyer des id au serveur, ce dernier doit être lancer sur un environnement JAVA avec le fichier jar "postgresql-42.5.1". Une fois lancer, lancer le client dans un environnement PYTHON. Ce dernier sera connecter ensuite au serveur sauf erreur. Le client est ensuite prêt à envoyer les id au serveur qui va ensuite faire des requête à la base de données pour débiter le client. En cas de réussite le serveur affichera le solde restant au client et la confirmation du débit du compte. Dans le cas contraire, le serveur informera que le client n'est pas débuter.
##Utilisation du site
Pour permettre à nos client de manger, il va falloir qu'il possède tout d'abord un compte et que ce dernier soit recharger. Notre site va donc permettre à la fois aux étudiants mais également aux personnels de l'université de créé leur compte ou accéder à leur profile. La page recharger quand à elle permet au client de recharger leur compte par des montants près défini. 