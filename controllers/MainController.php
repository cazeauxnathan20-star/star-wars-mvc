<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/FilmController.php";
require_once __DIR__ . "/VaisseauController.php";
require_once __DIR__ . "/UtilisateurController.php";
require_once __DIR__ . "/FavoriController.php";
require_once __DIR__ . "/PersonnageController.php";
require_once __DIR__ . "/../models/Film.php";
require_once __DIR__ . "/../models/Personnage.php";

function actionIndex() {
    $pdo = getConnexion();
    $films = getAllFilms($pdo);
    $personnages = getAllPersonnages($pdo);
    require __DIR__ . "/../views/index.php";
}

function getCurrentUserId(): ?int {
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

    return (int)$id;
}

function requireOwnershipOrDeny(string $resourceOwnerColumnValue, string $redirectUrl): void {
    $currentUserId = getCurrentUserId();
    if ($currentUserId === null) {
        header('Location: ' . $redirectUrl);
        exit;
    }

    $ownerId = (int)$resourceOwnerColumnValue;
    if ($currentUserId !== $ownerId) {
        header('Location: ' . $redirectUrl);
        exit;
    }
}

function getLesActions(): array {
    // Tableau associatif des actions
    $lesActions = array();

    $lesActions["defaut"]            = "film";

$lesActions["filmListe"]         = "film";

$lesActions["filmDetail"]        = "film";
$lesActions["filmAjouter"]       = "film";
$lesActions["filmModifier"]      = "film";
$lesActions["filmSupprimer"]     = "film";


// Note: on relie les actions au routeur index.php -> handleX()
$lesActions["personnageListe"]     = "personnage";
$lesActions["personnageDetail"]    = "personnage";
$lesActions["personnageAjouter"]   = "personnage";
$lesActions["personnageModifier"]  = "personnage";
$lesActions["personnageSupprimer"] = "personnage";

$lesActions["utilisateurListe"]     = "utilisateur";
$lesActions["utilisateurDetail"]    = "utilisateur";
$lesActions["utilisateurAjouter"]   = "utilisateur";
$lesActions["utilisateurModifier"]  = "utilisateur";
$lesActions["utilisateurSupprimer"] = "utilisateur";

$lesActions["vaisseauListe"]     = "vaisseau";
$lesActions["vaisseauDetail"]    = "vaisseau";
$lesActions["vaisseauAjouter"]   = "vaisseau";
$lesActions["vaisseauModifier"]  = "vaisseau";
$lesActions["vaisseauSupprimer"] = "vaisseau";

$lesActions["favoriListe"]     = "favori";
$lesActions["favoriAjouter"]   = "favori";
$lesActions["favoriSupprimer"] = "favori";

// Les controllers n’ont pas encore été routés proprement pour les autres tables dans index.php
// (planete/espece/affiliation/commentaire)

$lesActions["planeteListe"] = "planete";
$lesActions["planeteDetail"] = "planete";
$lesActions["planeteAjouter"] = "planete";
$lesActions["planeteModifier"] = "planete";
$lesActions["planeteSupprimer"] = "planete";

// Mappe les actions aux routeurs correspondants dans index.php
// (ces routeurs appellent actionPlaneteRouter/actionEspeceRouter/etc.)
$lesActions["planeteListe"] = "planete";
$lesActions["planeteDetail"] = "planete";
$lesActions["planeteAjouter"] = "planete";
$lesActions["planeteModifier"] = "planete";
$lesActions["planeteSupprimer"] = "planete";

$lesActions["especeListe"] = "espece";
$lesActions["especeDetail"] = "espece";
$lesActions["especeAjouter"] = "espece";
$lesActions["especeModifier"] = "espece";
$lesActions["especeSupprimer"] = "espece";

$lesActions["affiliationListe"] = "affiliation";
$lesActions["affiliationDetail"] = "affiliation";
$lesActions["affiliationAjouter"] = "affiliation";
$lesActions["affiliationModifier"] = "affiliation";
$lesActions["affiliationSupprimer"] = "affiliation";

$lesActions["commentaireListe"] = "commentaire";
$lesActions["commentaireAjouter"] = "commentaire";
$lesActions["commentaireSupprimer"] = "commentaire";

    return $lesActions;
}

?>

