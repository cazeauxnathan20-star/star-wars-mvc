<?php
require_once __DIR__ . "/../models/Film.php";

function handleFilm($action) {
    $pdo = getConnexion();
    switch ($action) {
        case 'filmDetail':
            $film = getFilmById($pdo, $_GET['id']);
            require __DIR__ . "/../views/films/detail.php";
            break;

        case 'filmAjouter':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                createFilm($pdo, [
                    ':titre'       => $_POST['titre'],
                    ':date_sortie' => $_POST['date_sortie'],
                    ':episode'     => $_POST['episode'],
                    ':image_url'  => $_POST['image_url']
                ]);
                header('Location: index.php?action=filmListe');
                exit;
            }
            require __DIR__ . "/../views/films/ajouter.php";
            break;

        case 'filmModifier':
            $film = getFilmById($pdo, $_GET['id']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                updateFilm($pdo, [
                    ':titre'       => $_POST['titre'],
                    ':date_sortie' => $_POST['date_sortie'],
                    ':episode'     => $_POST['episode'],
                    ':image_url'  => $_POST['image_url'],
                    ':id'          => $_GET['id']
                ]);
                header('Location: index.php?action=filmListe');
                exit;
            }
            require __DIR__ . "/../views/films/modifier.php";
            break;

        case 'filmSupprimer':
            // Film: pas de champ owner dans le modèle actuel (table: film)
            // Par défaut, on bloque si on ne peut pas vérifier la propriété.
            header('Location: index.php?action=filmListe');
            exit;


        default:
            $films = getAllFilms($pdo);
            require __DIR__ . "/../views/films/liste.php";
            break;
    }
}
?>