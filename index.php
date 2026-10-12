<?php
require_once __DIR__ . "/controllers/MainController.php";
require_once __DIR__ . "/controllers/RouterControllers.php";

$lesActions = getLesActions();
$action = $_GET['action'] ?? 'defaut';

if ($action === 'defaut') {
    actionIndex();
} elseif (array_key_exists($action, $lesActions)) {
    $module = $lesActions[$action];

    switch ($module) {
        case 'film':        handleFilm($action);        break;
        case 'vaisseau':    handleVaisseau($action);    break;
        case 'utilisateur': handleUtilisateur($action); break;
        case 'personnage':  handlePersonnage($action);  break;
        case 'favori':      handleFavori($action);      break;

        case 'planete':      actionPlaneteRouter($action); break;
        case 'espece':
            actionEspeceRouter($action);
            break;
        case 'affiliation':  actionAffiliationRouter($action); break;
        case 'commentaire':  actionCommentaireRouter($action); break;
    }
} else {
    echo "<h1>404 - Action introuvable</h1>";
}
?>

