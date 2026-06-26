<?php
require_once __DIR__ . "/../models/Utilisateur.php";

function handleUtilisateur($action) {
    $pdo = getConnexion();
    switch ($action) {
        case 'utilisateurDetail':
            $utilisateur = getUtilisateurById($pdo, $_GET['id']);
            require __DIR__ . "/../views/utilisateurs/detail.php";
            break;

        case 'utilisateurAjouter':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                createUtilisateur($pdo, [
                    ':pseudo'       => $_POST['pseudo'],
                    ':email'        => $_POST['email'],
                    ':mot_de_passe' => $_POST['mot_de_passe']
                ]);
                header('Location: index.php?action=utilisateurListe');
                exit;
            }
            require __DIR__ . "/../views/utilisateurs/ajouter.php";
            break;

        case 'utilisateurModifier':
            $utilisateur = getUtilisateurById($pdo, $_GET['id']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                updateUtilisateur($pdo, [
                    ':pseudo'       => $_POST['pseudo'],
                    ':email'        => $_POST['email'],
                    ':mot_de_passe' => $_POST['mot_de_passe'],
                    ':id'           => $_GET['id']
                ]);
                header('Location: index.php?action=utilisateurListe');
                exit;
            }
            require __DIR__ . "/../views/utilisateurs/modifier.php";
            break;

        case 'utilisateurSupprimer':
            $currentUserId = getCurrentUserId();
            if ($currentUserId === null) {
                header('Location: index.php?action=utilisateurListe');
                exit;
            }

            requireOwnershipOrDeny((string)$_GET['id'], 'index.php?action=utilisateurListe');
            deleteUtilisateur($pdo, (int)$_GET['id']);
            header('Location: index.php?action=utilisateurListe');
            exit;


        default:
            $utilisateurs = getAllUtilisateurs($pdo);
            require __DIR__ . "/../views/utilisateurs/liste.php";
            break;
    }
}
?>