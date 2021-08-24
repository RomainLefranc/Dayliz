# Dayliz


## Documentation de l'API

BASE_URL + /api/documentation


## Initialisation du projet

### Cloner le projet

`git clone git@github.com:RomainLefranc/Dayliz_backend.git`

### Set up env variables

Copier le contenu du fichier _.env.example_ dans un nouveau fichier _.env_ à la racine du projet.  
Modifier les informations de connexion à la BDD.

### Installation des dépendances via composer

`composer install`

### Migration et seeding

`php artisan migrate:fresh --seed`

## Principaux Backlog

| En tant que | Je peux                     | Afin de                           | Fonctionnalité          | Avancement |
| ----------- | --------------------------- | --------------------------------- | ----------------------- | ---------- |
| Utilisateur | Me connecter                | D'accéder à l'appli               | Authentification        |  WIP          |
| Utilisateur | Me déconnecter              | De quitter l'appli                | Authentification        |  WIP          |
| Utilisateur | Ajouter une activité        | Gérer mes activités               | CRUD activité           | Terminé    |
| Utilisateur | Voir mes activités          | Avoir une vision de mes activités | CRUD activité           |     WP   |
| Admin       | Créer un utilisateur        | Lui permettre de se connecter     | CRUD compte utilisateur | Terminé    |
| Admin       | Désactiver un utilisateur   | Supprimer son compte              | CRUD compte utilisateur | Terminé    |
| Admin       | Me connecter                | D'accéder à l'appli               | Authentification        |WIP
| Admin       | Me déconnecter              | De quitter l'appli                | Authentification        |WIP
| Admin       | Ajouter une activité        | Gérer les activités               | CRUD activité           | Terminé    |
| Admin       | Voir la liste des activités | Avoir une vision d'ensemble       | CRUD activité           | Terminé    |
| Admin       | Désactiver une activité     | Gérer les activités               | CRUD activité           | Terminé    |
| Admin       | Génerer le token d'une promo     | Voir des planning            | CRUD promo           |  |
| Admin       | Ajouter une promotion       | Gérer des planning                | CRUD promo           | Terminé|

## En ligne 

Ajouter la variable d'environnement `L5_SWAGGER_CONST_HOST` qui est égale à la base url 

Ex : L5_SWAGGER_CONST_HOST='https://dayliz.herokuapp.com//api'

## MCD Gaultier

![mcd_gaultier](https://user-images.githubusercontent.com/69463293/123043960-19a5f480-d40a-11eb-8fd3-64eec1c11993.png)

## MCD v1

![MCD v1](https://user-images.githubusercontent.com/69463293/123043897-06932480-d40a-11eb-80b7-f17a9374287a.png)

## MCD v2

![MCD v2](https://user-images.githubusercontent.com/69463293/123043927-13177d00-d40a-11eb-9e13-8233cdb737f8.png)

## Schema projet

![image](https://user-images.githubusercontent.com/69463293/126984260-70e369e4-294d-44ad-9150-a8dd2678c679.png)

