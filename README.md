# Star Wars MVC

Site web dynamique sur l'univers Star Wars, réalisé en PHP avec une
architecture MVC et une base de données MySQL.
Projet réalisé dans le cadre du BTS SIO option SLAM.

## Fonctionnalités
- Consultation des personnages, vaisseaux et planètes
- Pages dynamiques alimentées par la base de données
- Navigation entre les sections du site

## Technologies
PHP, MySQL, HTML, CSS, XAMPP, phpMyAdmin, Visual Studio Code, Git

## Architecture MVC

| Dossier | Rôle |
|---|---|
| `config/` | Connexion à la base de données |
| `models/` | Requêtes SQL et accès aux données |
| `controllers/` | Logique du site, lien entre modèles et vues |
| `views/` | Affichage HTML/CSS |
| `public/` | CSS, images |
| `index.php` | Point d'entrée : reçoit les requêtes et appelle le bon contrôleur |

### Exemple : affichage de la liste des personnages
1. L'utilisateur ouvre la page des personnages
2. `index.php` appelle le contrôleur correspondant
3. Le contrôleur demande les données au modèle
4. Le modèle exécute la requête SQL
5. Le contrôleur envoie les résultats à la vue, qui les affiche

## Base de données
![Schéma relationnel](docs/schema-relationnel.png)

Tables principales : `personnages`, `vaisseaux`, `planetes`
(détaille ici les champs et les clés étrangères)

## Installation
1. Installer XAMPP et démarrer Apache et MySQL
2. Cloner le dépôt dans `C:/xampp/htdocs/`
3. Ouvrir phpMyAdmin, créer une base `starwars`
4. Importer le fichier `database/starwars.sql`
5. Vérifier les identifiants dans `config/`
6. Ouvrir `http://localhost/star-wars-mvc/`

## Captures d'écran
![Accueil](docs/captures/accueil.png)
![Personnages](docs/captures/personnages.png)

## Tests réalisés
| Test | Résultat attendu | Résultat |
|---|---|---|
| Affichage de la liste des personnages | Tous les éléments de la BDD s'affichent | OK |
| Navigation entre les sections | Chaque lien mène à la bonne page | OK |

