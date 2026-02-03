# PizzaQuest 🍕
## Projet de développement web - Colint School

---

## L'histoire de PizzaQuest

Marco, le propriétaire de **PizzaQuest**, une petite pizzeria de quartier, vient de te contacter. Il a besoin d'une solution web pour moderniser son activité. Actuellement, il gère tout sur papier : les commandes, le menu, les prix... C'est devenu ingérable.

Il te confie la mission de créer une application web qui permettra à ses clients de consulter le menu en ligne et de passer des commandes, tout en lui donnant un espace d'administration pour gérer ses pizzas et suivre les commandes.

**Le défi** : Tu vas construire cette application de A à Z en PHP natif, sans framework, en apprenant les bases solides du développement web. Chaque semaine, tu vas acquérir de nouvelles compétences et les mettre en pratique directement sur le projet.

---

## Le contexte technique

Tu vas travailler avec :
- **PHP 7.4+ ou 8+** (sans framework, pour comprendre les fondamentaux)
- **Apache + PHP** (via MAMP sur Mac)
- **MySQL** pour la base de données
- **PDO** pour communiquer avec la base (requêtes préparées uniquement)
- **Bootstrap 5** pour l'interface utilisateur
- **Git** pour versionner ton code (branches, merges, résolution de conflits)
- **Monolog** (librairie PHP) pour le monitoring et les logs

---

## Structure du projet attendue

Pour garder un code propre et maintenable, tu devras organiser ton projet ainsi :

```
pizzaquest/
├── index.php          # Point d'entrée (front controller)
├── composer.json      # Dépendances PHP (Monolog)
├── includes/          # Éléments réutilisables
│   ├── header.php
│   ├── footer.php
│   ├── nav.php
│   └── bootstrap.php
├── pages/             # Pages d'affichage (ou views/)
│   ├── accueil.php
│   ├── menu.php
│   └── ...
├── src/               # Logique métier
│   ├── db.php         # Connexion à la base
│   ├── auth.php       # Gestion de l'authentification
│   └── helpers.php    # Fonctions utilitaires
├── logs/              # Fichiers de logs (Monolog)
└── README.md
```

---

## Fonctionnalités à développer

### Partie A — Côté client (visiteur)

**Page d'accueil**
- Présentation de PizzaQuest
- Mise en avant de la "Pizza du jour" (dynamique, récupérée depuis la base)

**Menu**
- Affichage de toutes les pizzas disponibles (sous forme de cards Bootstrap)
- Page de détail pour chaque pizza (accessible via `?id=...`)

**Passer une commande**
- Formulaire avec : sélection de pizza, quantité, commentaire optionnel
- La commande est liée à l'utilisateur connecté (type "user")
- Validation côté serveur avec affichage des erreurs
- Redirection après succès (pattern PRG : Post-Redirect-Get)

### Partie B — Authentification

**Connexion / Déconnexion**
- Formulaire de connexion (email + mot de passe)
- Gestion des sessions PHP
- Mots de passe hashés avec `password_hash()`
- Protection des pages admin : impossible d'y accéder sans être connecté en tant qu'admin

### Partie C — Administration (CRUD)

**Gestion des pizzas**
- Liste des pizzas (table Bootstrap)
- Ajouter une nouvelle pizza
- Modifier une pizza existante (notamment pour définir la "pizza du jour")
- Supprimer une pizza (avec confirmation)

**Gestion des commandes**
- Liste de toutes les commandes (table Bootstrap)
- Modifier une commande (changer le statut par exemple)
- Supprimer une commande (avec confirmation)

---

## Sécurité : non négociable

Tu devras absolument respecter ces règles de sécurité :

- **XSS** : Toute donnée provenant de l'utilisateur affichée à l'écran doit être échappée avec `htmlspecialchars()` (ou une fonction `e()` que tu créeras)
- **Mots de passe** : Utiliser `password_hash()` à l'inscription et `password_verify()` à la connexion
- **Sessions** : Stocker uniquement `user_id` et `role` dans la session
- **Injection SQL** : Aucune concaténation de chaînes dans les requêtes SQL. Uniquement des requêtes préparées avec PDO

---

## Base de données

Tu devras créer trois tables principales :

**`users`**
- `id` (PK, auto-increment)
- `email` (unique)
- `password_hash`
- `role` (ex: 'admin' ou 'user')
- `created_at`

**`pizzas`**
- `id` (PK, auto-increment)
- `name`
- `price` (décimal)
- `description`
- `is_pizza_du_jour` (booléen, optionnel)
- `created_at`

**`orders`**
- `id` (PK, auto-increment)
- `user_id` (FK vers users - l'utilisateur de type "user" qui passe la commande)
- `pizza_id` (FK vers pizzas)
- `quantity`
- `comment` (optionnel)
- `statut` (ex: 'en attente', 'en préparation', 'prête', 'livrée')
- `created_at`

*Questions à te poser :*
- *Comment gérer les commandes pour les utilisateurs non connectés ? (optionnel : permettre les commandes sans compte, ou forcer l'inscription)*
- *Comment afficher l'historique des commandes d'un utilisateur connecté ?*
- *Quelle relation utiliser entre users et orders ? (un utilisateur peut avoir plusieurs commandes)*

---

## Planning semaine par semaine

### Semaine 1 — Découverte du web et premiers pas en PHP

**Lundi : Montée en compétences** 🎓 (7h)

*Objectif : Comprendre les bases avant de coder*

**Vidéos à regarder (3-4h) :**
- [PHP pour débutants - Les bases](https://www.youtube.com/watch?v=...) (ou équivalent)
- [Comment fonctionne le web : HTTP, client/serveur](https://www.youtube.com/watch?v=...)
- [Bootstrap 5 - Tutoriel complet](https://www.youtube.com/watch?v=...)

**Pratique et recherche (3-4h) :**
- Installer MAMP sur Mac et créer ta première page PHP
- Faire un mini-exercice : créer 3 pages PHP simples avec un menu de navigation
- Tester Bootstrap : créer une page avec navbar, cards et un formulaire basique
- **Complément** : Apprendre à utiliser la documentation PHP.net efficacement. Faire des recherches sur les fonctions PHP courantes (array, string, etc.) et comprendre comment lire la doc officielle.
- **Complément** : Découvrir les outils de développement navigateur (DevTools) : inspecter le HTML, voir les requêtes HTTP, comprendre les erreurs console.

**Objectifs de la semaine :**
- Comprendre le fonctionnement client/serveur et HTTP
- Générer des pages PHP dynamiques
- Mettre en place Bootstrap et créer une structure de projet claire

**Livrables attendus :**
- Navbar Bootstrap fonctionnelle avec layout commun (header/footer)
- Pages : accueil, menu, détail pizza
- Données des pizzas stockées dans un tableau PHP (pas encore de base de données)
- Code structuré : `index.php` comme point d'entrée + dossier `includes/`

**Conseil** : Ne te précipite pas sur la base de données. Commence simple avec des tableaux PHP, tu verras la DB la semaine 4.

---

### Semaine 2 — Formulaires et organisation du code

**Lundi : Montée en compétences** 🎓 (7h)

*Objectif : Maîtriser les formulaires et la validation*

**Vidéos à regarder (3-4h) :**
- [PHP : $_GET et $_POST expliqués](https://www.youtube.com/watch?v=...)
- [Validation de formulaires en PHP](https://www.youtube.com/watch?v=...)
- [Pattern PRG (Post-Redirect-Get) - Pourquoi et comment](https://www.youtube.com/watch?v=...)
- [Séparation des responsabilités en PHP](https://www.youtube.com/watch?v=...)

**Pratique et recherche (3-4h) :**
- Créer un formulaire de contact avec validation (nom, email, message)
- Implémenter le pattern PRG sur ce formulaire
- Créer un fichier `helpers.php` avec des fonctions réutilisables (ex: `e()` pour échapper, `redirect()`)
- **Complément** : Découvrir les fonctions PHP pour manipuler les tableaux : `array_map()`, `array_filter()`, `array_reduce()`. Faire des exercices pratiques pour comprendre leur utilité.
- **Complément** : Apprendre à rechercher efficacement sur Stack Overflow, GitHub, et la documentation. Comprendre comment formuler une question de recherche pertinente et évaluer la qualité des réponses trouvées.

**Objectifs de la semaine :**
- Maîtriser `$_GET` et `$_POST`
- Valider les données côté serveur
- Comprendre et implémenter le pattern PRG
- Séparer la logique métier de l'affichage

**Livrables attendus :**
- Page "Passer commande" avec formulaire Bootstrap complet
- Traitement serveur avec validation rigoureuse + affichage des erreurs
- Redirection après succès + message de confirmation (Bootstrap alert)
- Helpers dans `src/helpers.php` ou `includes/functions.php`

**Conseil** : Prends le temps de bien valider chaque champ. Pense aux cas limites : champs vides, caractères spéciaux, quantités négatives...

---

### Semaine 3 — Sécurité et authentification

**Lundi : Montée en compétences** 🎓 (7h)

*Objectif : Sécuriser ton application*

**Vidéos à regarder (3-4h) :**
- [Sécurité web : XSS expliqué et comment s'en protéger](https://www.youtube.com/watch?v=...)
- [PHP : Sessions expliquées en détail](https://www.youtube.com/watch?v=...)
- [Hashage de mots de passe : password_hash() et password_verify()](https://www.youtube.com/watch?v=...)
- [Injection SQL : comprendre le danger](https://www.youtube.com/watch?v=...)

**Pratique et recherche (3-4h) :**
- Créer une fonction `e()` pour échapper toutes les sorties
- Implémenter un système de login/logout basique avec sessions
- Tester le hashage de mots de passe (créer un utilisateur, se connecter)
- **Complément** : Comprendre les différents algorithmes de hashage (bcrypt, argon2). Expérimenter avec `password_hash()` et comprendre les options (cost, algorithm).
- **Complément** : Rechercher et comprendre les bonnes pratiques de sécurité web (OWASP Top 10). Faire un mini-audit de sécurité sur ton code existant.

**Objectifs de la semaine :**
- Protéger contre les attaques XSS
- Comprendre et utiliser les sessions PHP
- Hasher et vérifier les mots de passe correctement
- Restreindre l'accès aux pages admin

**Livrables attendus :**
- `login.php` et `logout.php` fonctionnels
- Authentification via session
- Pages admin protégées : impossible d'y accéder sans être connecté en admin
- Utilisation systématique de `e()` pour échapper toutes les données utilisateur

**Conseil** : Teste bien ta sécurité. Essaie d'accéder à une page admin sans être connecté, vérifie que ça redirige bien vers le login.

---

### Semaine 4 — Base de données, CRUD et Git avancé

**Lundi : Montée en compétences** 🎓 (7h)

*Objectif : Maîtriser PDO et le versioning avec Git*

**Vidéos à regarder (3-4h) :**
- [PDO en PHP : connexion et requêtes préparées](https://www.youtube.com/watch?v=...)
- [CRUD complet en PHP avec PDO](https://www.youtube.com/watch?v=...)
- [Git : branches, merge et résolution de conflits](https://www.youtube.com/watch?v=...)
- [Architecture MVC simplifiée en PHP](https://www.youtube.com/watch?v=...)

**Pratique et recherche (3-4h) :**
- Créer une base de données MySQL et se connecter avec PDO
- Faire un CRUD simple (ex: gestion de produits) avec PDO
- Créer des branches Git, faire des merges, créer volontairement un conflit et le résoudre
- **Complément** : Découvrir les JOIN SQL (INNER, LEFT, RIGHT). Comprendre comment récupérer des données liées entre plusieurs tables (ex: récupérer les commandes avec les infos de l'utilisateur et de la pizza).
- **Complément** : Maîtriser les commandes Git avancées : `git rebase`, `git stash`, `git log --graph`. Comprendre quand utiliser merge vs rebase. Apprendre à lire l'historique Git efficacement.
- **Complément** : Installer et configurer Monolog. Comprendre les différents niveaux de log et créer tes premiers logs dans une application PHP.

**Objectifs de la semaine :**
- Maîtriser PDO et les requêtes préparées
- Implémenter un CRUD complet
- Mettre en place un routage simple (front controller)
- Utiliser Git de manière professionnelle (branches, merges, résolution de conflits)

**Livrables attendus :**
- Connexion à la base de données centralisée dans `src/db.php`
- CRUD pizzas complet (Create, Read, Update, Delete)
- Migration des données depuis les tableaux PHP vers MySQL
- Routage via `index.php?route=...` (ex: `?route=menu`, `?route=admin/pizzas`)
- **Monolog intégré** : au moins 5 points de logging dans l'application
- Repository Git propre avec :
  - Branches `main` et `develop` créées
  - Plusieurs branches feature (ex: `feature/auth`, `feature/crud-pizzas`)
  - **Pull Requests utilisées** : toutes les fonctionnalités mergées via PR
  - **Aucun push direct sur `main`** (vérifié dans l'historique)
  - Au moins un conflit résolu (montrer la résolution dans l'historique)

**Conseil** : N'hésite pas à créer plusieurs branches pour chaque fonctionnalité. C'est une bonne pratique et ça te prépare au travail en équipe.

---

## Critères d'évaluation

Ton projet sera évalué sur :

✅ **Interface utilisateur**
- Design propre avec Bootstrap
- Responsive (mobile, tablette, desktop)
- Messages utilisateur clairs (erreurs en rouge, succès en vert)

✅ **Qualité du code**
- Code lisible et bien organisé
- Structure de dossiers respectée
- Fonctions réutilisables

✅ **Sécurité**
- Protection XSS (échappement systématique)
- Mots de passe hashés
- Sessions sécurisées
- Requêtes SQL préparées (aucune injection possible)

✅ **Fonctionnalités**
- CRUD complet et fonctionnel
- Authentification opérationnelle
- Toutes les pages demandées présentes

✅ **Git**
- Historique clair et cohérent
- Branches `main` et `develop` présentes
- Utilisation de Pull Requests (aucun push direct sur `main`)
- Branches feature bien nommées
- Merges propres
- Au moins un conflit résolu

✅ **Monitoring**
- Monolog installé et configuré
- Logs pertinents à différents endroits de l'application
- Compréhension de l'utilité du monitoring démontrée

---

## Ressources utiles

**Documentation officielle :**
- [PHP.net](https://www.php.net/manual/fr/)
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [PDO](https://www.php.net/manual/fr/book.pdo.php)
- [Monolog](https://github.com/Seldaek/monolog)

**Outils :**
- MAMP (Mac) - [Téléchargement](https://www.mamp.info/en/downloads/)
- Composer (gestionnaire de dépendances PHP) - [Installation](https://getcomposer.org/download/)
- Git
- Un éditeur de code (VS Code recommandé)

---

## Workflow Git : règles strictes

**⚠️ IMPORTANT : Tu dois absolument respecter ce workflow Git**

### Structure des branches

Ton repository doit avoir **deux branches principales** :
- **`main`** : Branche de production, code stable et testé
- **`develop`** : Branche de développement, où tu intègres tes nouvelles fonctionnalités

### Règles absolues

1. **Tu ne dois JAMAIS push directement sur `main`**
   - La branche `main` est protégée
   - Toute modification doit passer par une Pull Request (PR)

2. **Workflow obligatoire :**
   ```
   1. Créer une branche depuis `develop` : 
      git checkout develop
      git pull origin develop
      git checkout -b feature/nom-de-la-fonctionnalite
   
   2. Développer ta fonctionnalité sur cette branche
   
   3. Push ta branche :
      git push origin feature/nom-de-la-fonctionnalite
   
   4. Créer une Pull Request sur GitHub/GitLab :
      - Source : feature/nom-de-la-fonctionnalite
      - Destination : develop
      - Décris ce que tu as fait dans la PR
   
   5. Une fois la PR validée et mergée dans `develop`, 
      créer une nouvelle PR pour merger `develop` → `main`
   ```

3. **Nommage des branches :**
   - `feature/nom-fonctionnalite` (ex: `feature/auth`, `feature/crud-pizzas`)
   - `fix/nom-du-bug` (ex: `fix/login-redirect`)
   - `refactor/nom-refactoring`

4. **Pull Requests :**
   - Chaque PR doit avoir une description claire
   - Indique ce qui a été ajouté/modifié
   - Mentionne les fichiers principaux modifiés
   - Une PR = une fonctionnalité ou un bug fix

5. **Commits :**
   - Messages de commit clairs et descriptifs
   - Exemple : `feat: ajout de l'authentification utilisateur`
   - Évite les commits du type "fix", "update", "wip"

### Exemple de workflow complet

```bash
# Initialisation (une seule fois)
git checkout -b develop
git push origin develop

# Pour chaque nouvelle fonctionnalité
git checkout develop
git pull origin develop
git checkout -b feature/ajout-menu-pizzas

# ... développement ...

git add .
git commit -m "feat: ajout de la page menu avec liste des pizzas"
git push origin feature/ajout-menu-pizzas

# Créer la PR sur GitHub : feature/ajout-menu-pizzas → develop
# Une fois mergée, supprimer la branche locale :
git checkout develop
git branch -d feature/ajout-menu-pizzas
```

**Rappel** : L'historique Git sera vérifié. Tout push direct sur `main` sera considéré comme une erreur.

---

## Monitoring avec Monolog

### Pourquoi le monitoring ?

Dans une application réelle, il est essentiel de savoir ce qui se passe : erreurs, actions des utilisateurs, performances... Le monitoring permet de :
- Détecter les bugs en production
- Comprendre le comportement des utilisateurs
- Améliorer les performances
- Déboguer plus facilement

### Intégration de Monolog

Tu devras intégrer **Monolog** (librairie PHP de logging) dans ton projet pour comprendre l'intérêt du monitoring.

**Installation :**
```bash
composer require monolog/monolog
```

**Utilisation minimale attendue :**
- Logger les erreurs (exceptions, erreurs SQL)
- Logger les actions importantes (connexion utilisateur, création de commande)
- Créer différents niveaux de logs (INFO, WARNING, ERROR)
- Stocker les logs dans un fichier

**Exemple d'utilisation :**
```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('pizzaquest');
$logger->pushHandler(new StreamHandler('logs/app.log', Logger::INFO));

// Logger une action
$logger->info('Utilisateur connecté', ['user_id' => $userId]);

// Logger une erreur
$logger->error('Erreur lors de la création de la commande', ['error' => $e->getMessage()]);
```

**Livrable attendu :**
- Monolog installé et configuré
- Au moins 5 points de logging dans l'application (connexion, erreurs, actions admin)
- Fichier de logs créé et consultable
- Compréhension de l'utilité du monitoring expliquée dans le README

**Complément (Semaine 4) :**
- Découvrir les différents handlers Monolog (fichier, email, Slack)
- Comprendre les niveaux de log (DEBUG, INFO, WARNING, ERROR, CRITICAL)
- Analyser les logs pour identifier un problème

---

**Bon courage avec PizzaQuest ! 🍕**