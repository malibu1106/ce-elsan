# ELSAN Back-End

## Description

Ce projet back-end utilise **PHP 8.3**, **MySQL 8.0**, et **Tailwind CSS**.  
L'environnement est entièrement conteneurisé avec **Docker** et la base de données est automatiquement initialisée avec des données préchargées.

---

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants :

- **Docker** et **Docker Compose** (pour exécuter les conteneurs).
- **Node.js** et **npm** (si vous souhaitez modifier les styles Tailwind CSS).

---

## Installation

### Étape 1 : Cloner le dépôt

Clonez le projet sur votre machine locale en utilisant la commande suivante :
git clone https://github.com/malibu1106/ce-elsan

### Étape 2 : Lancer les conteneurs avec Docker

Une fois dans le répertoire du projet, exécutez la commande suivante pour construire et démarrer les conteneurs Docker :
docker-compose up --build

Les services suivants seront accessibles :

- **Application PHP** : [http://localhost:8002](http://localhost:8002)
- **phpMyAdmin** : [http://localhost:8084](http://localhost:8084)

> **Remarque :** La base de données MySQL sera automatiquement configurée avec les données situées dans le répertoire `./data`.

---

## Configuration des styles avec Tailwind CSS _(Optionnel pour les développeurs)_

Si vous souhaitez personnaliser les styles avec **Tailwind CSS**, voici les étapes à suivre :

### 1. Installer les dépendances Node.js

Tout d'abord, installez les dépendances nécessaires avec npm :
npm install

### 2. Compiler les styles Tailwind CSS

Lancez la commande suivante pour activer le mode "watch" de Tailwind et générer les styles CSS en temps réel :

- **`-i`** : Fichier d'entrée pour Tailwind CSS (input.css).
- **`-o`** : Fichier de sortie généré par Tailwind (output.css).
- **`--watch`** : Active le mode observation des fichiers pour appliquer les changements automatiquement.

Les styles seront générés dans le fichier `output.css`.

---

## Structure des Conteneurs

### Services définis :

- **PHP 8.3**  
  Serveur Apache configuré pour héberger l'application PHP.  
  Accessible sur [http://localhost:8002](http://localhost:8002).

- **MySQL 8.0**  
  Base de données avec les paramètres suivants :

  - **Nom de la base de données** : `elsan`
  - **Utilisateur** : `elsan_admin`
  - **Mot de passe** : `elsan_password`
  - Port local : `3367`.

- **phpMyAdmin**  
  Interface de gestion de la base de données via une interface web.  
  Accessible sur [http://localhost:8084](http://localhost:8084).  
  Connexion par défaut :
  - **Utilisateur** : `root`
  - **Mot de passe** : `root`

---

## Commandes Utiles

- **Arrêter les conteneurs** :  
  docker-compose down

- **Rebuild des conteneurs** :  
  docker-compose up --build

- **Recompiler les styles Tailwind CSS manuellement** :  
  npx tailwindcss -i ./src/css/input.css -o ./src/output.css
