<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/FilmController.php";
require_once __DIR__ . "/VaisseauController.php";
require_once __DIR__ . "/UtilisateurController.php";
require_once __DIR__ . "/FavoriController.php";
require_once __DIR__ . "/PersonnageController.php";
require_once __DIR__ . "/PlaneteController.php";
require_once __DIR__ . "/EspeceController.php";
require_once __DIR__ . "/AffiliationController.php";
require_once __DIR__ . "/CommentaireController.php";
require_once __DIR__ . "/../models/Film.php";
require_once __DIR__ . "/../models/Personnage.php";

class MainController
{
    public function route(string $action): void
    {
        if ($action === 'defaut') {
            $this->index();
            return;
        }

        $lesActions = $this->getLesActions();
        if (!array_key_exists($action, $lesActions)) {
            echo "<h1>404 - Action introuvable</h1>";
            return;
        }

        $router = new RouterControllers();
        $router->dispatch($action, $lesActions[$action]);
    }

    public function index(): void
    {
        $pdo = Database::getConnexion();
        $films = getAllFilms($pdo);
        $personnages = getAllPersonnages($pdo);
        require __DIR__ . "/../views/index.php";
    }

    public static function getCurrentUserId(): ?int
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            @session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        $id = $_SESSION['user_id'];
        if (!is_numeric($id)) {
            return null;
        }

        return (int) $id;
    }

    public static function requireOwnershipOrDeny(string $resourceOwnerColumnValue, string $redirectUrl): void
    {
        $currentUserId = self::getCurrentUserId();
        if ($currentUserId === null) {
            header('Location: ' . $redirectUrl);
            exit;
        }

        $ownerId = (int) $resourceOwnerColumnValue;
        if ($currentUserId !== $ownerId) {
            header('Location: ' . $redirectUrl);
            exit;
        }
    }

    public function getLesActions(): array
    {
        return [
            'defaut' => 'film',
            'filmListe' => 'film',
            'filmDetail' => 'film',
            'filmAjouter' => 'film',
            'filmModifier' => 'film',
            'filmSupprimer' => 'film',

            'personnageListe' => 'personnage',
            'personnageDetail' => 'personnage',
            'personnageAjouter' => 'personnage',
            'personnageModifier' => 'personnage',
            'personnageSupprimer' => 'personnage',

            'utilisateurListe' => 'utilisateur',
            'utilisateurDetail' => 'utilisateur',
            'utilisateurAjouter' => 'utilisateur',
            'utilisateurModifier' => 'utilisateur',
            'utilisateurSupprimer' => 'utilisateur',

            'vaisseauListe' => 'vaisseau',
            'vaisseauDetail' => 'vaisseau',
            'vaisseauAjouter' => 'vaisseau',
            'vaisseauModifier' => 'vaisseau',
            'vaisseauSupprimer' => 'vaisseau',

            'favoriListe' => 'favori',
            'favoriAjouter' => 'favori',
            'favoriSupprimer' => 'favori',

            'planeteListe' => 'planete',
            'planeteDetail' => 'planete',
            'planeteAjouter' => 'planete',
            'planeteModifier' => 'planete',
            'planeteSupprimer' => 'planete',

            'especeListe' => 'espece',
            'especeDetail' => 'espece',
            'especeAjouter' => 'espece',
            'especeModifier' => 'espece',
            'especeSupprimer' => 'espece',

            'affiliationListe' => 'affiliation',
            'affiliationDetail' => 'affiliation',
            'affiliationAjouter' => 'affiliation',
            'affiliationModifier' => 'affiliation',
            'affiliationSupprimer' => 'affiliation',

            'commentaireListe' => 'commentaire',
            'commentaireAjouter' => 'commentaire',
            'commentaireSupprimer' => 'commentaire',
        ];
    }
}
?>

