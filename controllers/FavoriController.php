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
            $currentUserId = getCurrentUserId();
            if ($currentUserId === null) {
                header('Location: index.php?action=favoriListe');
                exit;
            }

            // On force l'id_user à l'utilisateur connecté (et on ignore celui passé en URL)
            deleteFavori($pdo, $currentUserId, (int)$_GET['id_personnage']);
            header('Location: index.php?action=favoriListe');
            exit;


        default:
            $favoris = getAllFavoris($pdo);
            require __DIR__ . "/../views/favoris/liste.php";
            break;
    }
}
?>