<?php
require_once __DIR__ . '/controllers/MainController.php';
require_once __DIR__ . '/controllers/RouterControllers.php';
require_once __DIR__ . '/controllers/AffiliationController.php';

$action = $_GET['action'] ?? 'defaut';

if ($action === 'defaut') {
	actionIndex();
	exit;
}

$lesActions = getLesActions();
if (!array_key_exists($action, $lesActions)) {
	http_response_code(404);
	echo '<h1>404 - Action introuvable</h1>';
	exit;
}

switch ($lesActions[$action]) {
	case 'film':
		(new FilmController())->handleAction($action);
		break;
	case 'personnage':
		handlePersonnage($action);
		break;
	case 'vaisseau':
		handleVaisseau($action);
		break;
	case 'utilisateur':
		handleUtilisateur($action);
		break;
	case 'favori':
		handleFavori($action);
		break;
	case 'planete':
		actionPlaneteRouter($action);
		break;
	case 'espece':
		actionEspeceRouter($action);
		break;
	case 'affiliation':
		actionAffiliationRouter($action);
		break;
	case 'commentaire':
		actionCommentaireRouter($action);
		break;
}









