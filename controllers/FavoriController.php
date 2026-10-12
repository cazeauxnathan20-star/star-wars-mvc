<?php
require_once __DIR__ . "/../models/Favori.php";

function handleFavori($action) {
    $pdo = getConnexion();
    switch ($action) {
        case 'favoriAjouter':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                createFavori($pdo, [
                    ':id_user'       => $_POST['id_user'],
                    ':id_personnage' => $_POST['id_personnage']
                ]);
                header('Location: index.php?action=favoriListe');
                exit;
            }
            $utilisateurs = getAllUtilisateursPourFavori($pdo);
            $personnages  = getAllPersonnagesPourFavori($pdo);
            require __DIR__ . "/../views/favoris/ajouter.php";
            break;

        case 'favoriSupprimer':
            deleteFavori($pdo, $_GET['id_user'], $_GET['id_personnage']);
            header('Location: index.php?action=favoriListe');
            exit;

        default:
            $favoris = getAllFavoris($pdo);
            require __DIR__ . "/../views/favoris/liste.php";
            break;
    }
}
?>