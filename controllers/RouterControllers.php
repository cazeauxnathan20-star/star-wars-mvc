<?php
require_once __DIR__ . '/FilmController.php';
require_once __DIR__ . '/PersonnageController.php';
require_once __DIR__ . '/UtilisateurController.php';
require_once __DIR__ . '/VaisseauController.php';
require_once __DIR__ . '/FavoriController.php';
require_once __DIR__ . '/PlaneteController.php';
require_once __DIR__ . '/EspeceController.php';
require_once __DIR__ . '/AffiliationController.php';
require_once __DIR__ . '/CommentaireController.php';

class RouterControllers
{
    public function dispatch(string $action, string $module): void
    {
        switch ($module) {
            case 'film':
                (new FilmController())->handle($action);
                break;

            case 'personnage':
                (new PersonnageController())->handle($action);
                break;

            case 'utilisateur':
                (new UtilisateurController())->handle($action);
                break;

            case 'vaisseau':
                (new VaisseauController())->handle($action);
                break;

            case 'favori':
                (new FavoriController())->handle($action);
                break;

            case 'planete':
                (new PlaneteController())->handle($action);
                break;

            case 'espece':
                (new EspeceController())->handle($action);
                break;

            case 'affiliation':
                (new AffiliationController())->handle($action);
                break;

            case 'commentaire':
                (new CommentaireController())->handle($action);
                break;
        }
    }
}

