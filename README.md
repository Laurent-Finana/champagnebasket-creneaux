# champagnebasket-creneaux

## Présentation

Cette application est un **calendrier partagé**.
Elle répond à un **besoin client**, un club de basket professionnel avec plusieurs équipes, 2 salles d'entraînements et une salle de musculation.
Les **coachs** peuvent visualiser, réserver ou modifier les différents créneaux de chaque salle.
Les **joueurs** peuvent visualiser et demander un créneau à leur coach pour un entrainement individuel via une **messagerie interne**.
Enfin un **utilisateur** lambda à juste la possibilité de visualiser les différents créneaux horaires.
Le ou les **administrateurs** ont également accès à un **backoffice** leur permettant d'avoir une vision d'ensemble et de gérer les utilisateurs avec leurs rôles.

L'application est fonctionnelle et déployée : [champagnebasket-creneaux](https://www.champagnebasket-creneaux.fr).

Il faut être validé par un administrateur pour accèder à la plupart des fonctionnalités, voici donc quelques captures d'écran pour un aperçu d'ensemble :

Exemple planning Grand Salle :
![ExempleGrandeSalle](public/assets/images/accueilAdmin.png)

Ajouter un nouveau créneau :
![ExempleNouveauCreneau](public/assets/images/nouveauCreneau.gif)

Modifier un créneau:
![ExempleModiiferCreneau](public/assets/images/modifCreneau.png)

Exemple d'un message reçu :
![ExempleMessageReçu](public/assets/images/messagerie.png)

Aperçu du backoffice :
![ExempleBackoffice](public/assets/images/backoffice.png)

## Technologies utilisées

- PHP 8 / Symfony 6
- JavaScript avec sa bibliothèque FullCalendar
- Twig
- Tailwind CSS
- EasyAdmin 4

## Installation du projet

- `composer install`
- Créer un fichier **.env.local** à la racine du projet
- Renseigner la base de données dans ce fichier .env.local
- Créer la base de données : `symfony console doctrine:database:create`
- Exécuter les migrations : `symfony console doctrine:migrations:migrate`
- Charger les fixtures `symfony console doctrine:fixtures:load -n` ou en créer manuellement via l'interface de la bdd (phpMyAdmin, adminer...)

- `npm install`
- `npm run watch`

## Contact

Pour toutes questions ou demandes : [Me contacter](mailto:laurentfinana@hotmail.fr)
