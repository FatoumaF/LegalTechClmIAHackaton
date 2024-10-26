

<img width="1212" alt="Capture d’écran 2024-10-26 à 16 47 54" src="https://github.com/user-attachments/assets/d9c04ef7-ccae-4a10-89d0-e1ec119f5360">
<img width="1440" alt="Capture d’écran 2024-10-26 à 16 47 18" src="https://github.com/user-attachments/assets/ab5d5862-8644-4678-813d-b6aaa58027df">
<img width="1440" alt="Capture d’écran 2024-10-26 à 16 46 39" src="https://github.com/user-attachments/assets/505fc7c7-5f07-48b9-8e6a-5962aa7aa68e">
<img width="1440" alt="Capture d’écran 2024-10-26 à 16 46 15" src="https://github.com/user-attachments/assets/c84ca51c-44ab-4991-958d-df8b48ede875">
<img width="719" alt="Capture d’écran 2024-10-26 à 16 45 52" src="https://github.com/user-attachments/assets/d09edb09-7e19-4434-b463-47e54c6e4c5e">
<img width="1439" alt="Capture d’écran 2024-10-26 à 16 45 23" src="https://github.com/user-attachments/assets/213c8c5c-17f8-473a-80b8-5525530aee9e">
<img width="1439" alt="Capture d’écran 2024-10-26 à 16 45 43" src="https://github.com/user-attachments/assets/bffdca6c-1423-4f3d-afb0-1f07eaa3dc70">
<img width="1439" alt="Capture d’écran 2024-10-26 à 16 43 17" src="https://github.com/user-attachments/assets/49fae448-f588-45c0-ae57-15f582c9b7a5">
<img width="1439" alt="Capture d’écran 2024-10-26 à 16 42 32" src="https://github.com/user-attachments/assets/2f2418aa-6aa2-4ebd-a008-e6e612721138">
---

# Gestion de Contrats - CLM v1

**Hackathon - Version 1**

## Description

Ce projet est la première version d'un système de gestion de contrats (CLM - Contract Lifecycle Management) développé en Symfony pour un Hackaton, avec l'intégration de **EasyAdmin** pour simplifier la gestion des entités. Le but de ce projet est de tester et d'apprendre le framework Symfony, ainsi que son intégration avec une base de données relationnelle et le front-end via **Twig**. Il ne s'agit pas de la version finale, mais plutôt d'un prototype pour explorer les possibilités offertes par Symfony et EasyAdmin.

## Fonctionnalités

- **Gestion des Contrats** : 
  - Création, modification, suppression des contrats directement depuis une interface utilisateur intuitive.
  - Automatisation de l'ajout de contrats en fonction de leur état (en création, en révision, approuvé, signé, complété).
  - Suivi du cycle de vie des contrats grâce à l'intégration de workflows personnalisés pour chaque état.

- **Signature Automatisée des Contrats** : 
  - Possibilité de gérer la signature des contrats en ligne, en fonction de leur état.

- **Intégration de Graphiques** :
  - Affichage de statistiques et graphiques sur le tableau de bord avec **Chart.js**.
  - Visualisation de l'état des contrats (en cours, révisés, approuvés, signés).
  - Graphique montrant le nombre de contrats signés au fil du temps.

- **Gestion des Documents** :
  - Possibilité d'ajouter, de modifier, de supprimer des documents liés aux contrats.
  - Téléchargement de documents multiples avec un système de gestion de fichiers.

- **Tableau de Bord** : 
  - Interface utilisateur simplifiée pour accéder aux contrats, tâches, et documents.
  - Onglet "Mes Tâches" pour gérer une to-do liste liée aux contrats et aux actions à réaliser.
  - **Calendrier** intégré pour visualiser les échéances et les dates importantes liées aux contrats.

## Objectifs du Projet

- **Apprentissage du Framework Symfony** :
  - Découverte des concepts fondamentaux de Symfony, tels que les entités, les formulaires, les services, et les contrôleurs.
  - Utilisation de **EasyAdmin** pour simplifier la gestion des entités et créer une interface d'administration fonctionnelle rapidement.
  - Intégration de **Chart.js** pour ajouter des éléments graphiques et visualiser des données dynamiquement.

- **Travail sur un Projet CLM** :
  - Développer une première version d'un CLM pour comprendre les bases de la gestion de contrats en entreprise.
  - Appréhender les besoins liés à l'automatisation de processus métier, tels que les workflows de validation et la gestion des documents.

- **Test et Expérimentation** :
  - Tester et expérimenter différentes fonctionnalités dans un cadre de hackathon.
  - Préparer le terrain pour une future version plus aboutie du projet, en améliorant la structure de la base de données et les fonctionnalités front-end.

## Technologies Utilisées

- **Symfony** (PHP) - Framework backend pour le développement de l'application.
- **EasyAdmin** - Pour la gestion de l'administration des entités (contrats, documents, utilisateurs).
- **Twig** - Moteur de template pour le rendu des vues.
- **Chart.js** - Bibliothèque JavaScript pour l'affichage de graphiques sur le tableau de bord.
- **Doctrine ORM** - Pour la gestion de la base de données (SQL).
- **Vite** - Pour la gestion des assets (CSS, JS).
- **Base de Données** - Utilisation de SQL pour le stockage des données liées aux contrats et aux utilisateurs.

## Installation

1. **Cloner le projet :**

   ```bash
   git clone https://github.com/votre-utilisateur/votre-projet.git
   cd votre-projet
   ```

2. **Installer les dépendances PHP :**

   ```bash
   composer install
   ```

3. **Configurer les variables d'environnement :**

   Copier le fichier `.env` et ajuster les informations de connexion à la base de données :

   ```bash
   cp .env .env.local
   ```

4. **Créer la base de données :**

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **Lancer le serveur Symfony :**

   ```bash
   symfony server:start
   ```

6. **Accéder à l'interface :**

   Ouvrez votre navigateur et allez à l'adresse suivante :

   ```
   http://localhost:8000/admin
   ```

## Contribution

Les contributions à ce projet sont les bienvenues, que ce soit pour l'amélioration des fonctionnalités existantes ou pour l'ajout de nouvelles idées. Ce projet étant un prototype, toute suggestion pour optimiser les processus et les intégrations est appréciée.

## Remarques Finales

Ce projet est une première étape dans la réalisation d'une solution complète de gestion de contrats. L'objectif est d'expérimenter et d'apprendre les meilleures pratiques de développement en Symfony. Les futures versions pourraient inclure des fonctionnalités plus avancées, telles que l'intégration d'API externes pour la signature numérique, une gestion plus poussée des rôles et permissions, et une interface utilisateur plus intuitive.

**Note** : Ce projet est réalisé dans le cadre d'un hackathon et n'est pas destiné à un usage en production. Il s'agit principalement d'une preuve de concept pour explorer les possibilités de Symfony et de l'administration de données avec EasyAdmin.

---
