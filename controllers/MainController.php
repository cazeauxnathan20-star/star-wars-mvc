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

function getLesActions(): array {
    
    $lesActions = array();

    $lesActions["defaut"]            = "film";

$lesActions["filmListe"]         = "film";

$lesActions["filmDetail"]        = "film";
$lesActions["filmAjouter"]       = "film";
$lesActions["filmModifier"]      = "film";
$lesActions["filmSupprimer"]     = "film";



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



$lesActions["planeteListe"] = "planete";
$lesActions["planeteDetail"] = "planete";
$lesActions["planeteAjouter"] = "planete";
$lesActions["planeteModifier"] = "planete";
$lesActions["planeteSupprimer"] = "planete";


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

