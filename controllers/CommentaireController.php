<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Commentaire.php";

function actionCommentaireIndex() {
    $pdo = getConnexion();
    $commentaires = getAllCommentaires($pdo);
    require __DIR__ . "/../views/commentaires/liste.php";
}

function actionCommentaireAjouter() {
    $pdo = getConnexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        createCommentaire($pdo, [
            ':contenu' => $_POST['contenu'],
            ':id_user' => $_POST['id_user'],
            ':id_personnage' => $_POST['id_personnage']
        ]);
        header('Location: index.php?action=commentaireListe');
        exit;
    }

    $utilisateurs = getAllUtilisateursPourCommentaire($pdo);
    $personnages = getAllPersonnagesPourCommentaire($pdo);

    require __DIR__ . "/../views/commentaires/ajouter.php";
}

function actionCommentaireSupprimer() {
    $pdo = getConnexion();
    $currentUserId = getCurrentUserId();
    if ($currentUserId === null) {
        header('Location: index.php?action=commentaireListe');
        exit;
    }

    $commentaire = $pdo->prepare("SELECT id_user FROM commentaire WHERE id_commentaire = :id");
    $commentaire->execute([':id' => (int)$_GET['id']]);
    $row = $commentaire->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header('Location: index.php?action=commentaireListe');
        exit;
    }

    requireOwnershipOrDeny($row['id_user'], 'index.php?action=commentaireListe');
    deleteCommentaire($pdo, (int)$_GET['id']);

    header('Location: index.php?action=commentaireListe');
    exit;
}


?>

