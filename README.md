# Gestion d'un Cabinet Médical

Projet développé dans le cadre du Contrôle Continu 2 (CC2) de la filière Développement Digital. Cette application permet la gestion numérique d'un cabinet médical à travers un système complet de gestion des rendez-vous, des services médicaux et des utilisateurs.

## Description du projet

L'application offre un environnement sécurisé permettant aux patients de prendre rendez-vous en ligne, aux médecins de consulter leurs consultations programmées et à l'administrateur de gérer l'ensemble du système.

Le projet repose sur Laravel et suit une architecture MVC avec une interface moderne développée à l'aide de Blade et Tailwind CSS.

## Fonctionnalités

### Gestion des utilisateurs

* Authentification sécurisée.
* Gestion des rôles :

  * Administrateur
  * Médecin
  * Patient
* Contrôle d'accès selon les permissions de chaque rôle.

### Gestion des rendez-vous

* Création de rendez-vous.
* Modification et suppression.
* Confirmation ou annulation des rendez-vous.
* Vérification automatique des conflits horaires.
* Recherche dynamique sans rechargement de page.

### Gestion des services médicaux

* Ajout de nouveaux services.
* Modification des informations.
* Suppression des services.
* Consultation de la liste des services disponibles.

### Tableau de bord

* Nombre total des rendez-vous.
* Rendez-vous en attente.
* Rendez-vous confirmés.
* Rendez-vous annulés.
* Visualisation graphique des statistiques.

### Notifications

* Envoi automatique d'un email de confirmation au patient après validation du rendez-vous.

### Internationalisation

Langues disponibles :

* Français
* Anglais
* Espagnol
* Arabe (RTL)

### API REST

Endpoints sécurisés via Laravel Sanctum permettant l'accès aux données depuis des applications externes.

## Technologies utilisées

### Backend

* PHP 8.3
* Laravel 13
* Laravel Sanctum

### Frontend

* Blade Templates
* Tailwind CSS
* Alpine.js
* Axios
* Chart.js

### Base de données

* MySQL

## Installation

Cloner le projet :

```bash
git clone <URL_DU_REPO>
cd cabinet-medical
```

Installer les dépendances :

```bash
composer install
npm install
```

Créer le fichier d'environnement :

```bash
cp .env.example .env
php artisan key:generate
```

Configurer la base de données dans le fichier `.env`.

Exécuter les migrations et les seeders :

```bash
php artisan migrate:fresh --seed
```

Compiler les ressources :

```bash
npm run build
```

Démarrer le serveur :

```bash
php artisan serve
```

## Comptes de démonstration

### Administrateur

Email : [admin@cabinet.test](mailto:admin@cabinet.test)

Mot de passe : 123456789

### Médecin

Email : [medecin@cabinet.test](mailto:medecin@cabinet.test)

Mot de passe : 123456789

### Patient

Email : [patient@cabinet.test](mailto:patient@cabinet.test)

Mot de passe : 123456789

Les seeders génèrent également des données de démonstration comprenant plusieurs utilisateurs, services médicaux et rendez-vous.

## API

### Authentification

```http
POST /api/login
```

### Services

```http
GET /api/services
```

### Rendez-vous

```http
GET /api/rendezvous
POST /api/rendezvous
```

### Déconnexion

```http
POST /api/logout
```

Toutes les routes protégées nécessitent un Bearer Token valide.

## Fonctionnalités techniques réalisées

* Architecture MVC Laravel.
* Authentification multi-rôles.
* Validation des formulaires.
* Protection CSRF.
* Gestion des conflits de rendez-vous.
* Requêtes AJAX avec Axios.
* API REST sécurisée.
* Support multilingue.
* Notifications par email.

## Auteur

Projet réalisé dans le cadre du CC2 - Développement Digital.
