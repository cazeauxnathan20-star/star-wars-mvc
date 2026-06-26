<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Personnage.php";

function handlePersonnage($action) {
    switch ($action) {
        case 'personnageDetail':
            actionPersonnageDetail();
            break;

        case 'personnageAjouter':
            actionPersonnageAjouter();
            break;

        case 'personnageModifier':
            actionPersonnageModifier();
            break;

        case 'personnageSupprimer':
            actionPersonnageSupprimer();
            break;

        default:
            actionPersonnageIndex();
            break;
    }
}

function actionPersonnageIndex() {
    $pdo = getConnexion();

    // 🔎 Gestion de la recherche
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $personnages = searchPersonnages($pdo, $_GET['search']);
    } else {
        $personnages = getAllPersonnages($pdo);
    }

    require __DIR__ . "/../views/personnages/liste.php";
}

function actionPersonnageDetail() {
    $pdo = getConnexion();
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $personnage = getPersonnageById($pdo, $id);
    require __DIR__ . "/../views/personnages/detail.php";
}

function actionPersonnageAjouter() {
    $pdo = getConnexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = null;

        // Upload image (optionnel)
        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/personnages/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            // Limite extension simple
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('perso_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }

        }

        // si pas d'image, garder null
        if ($imageFilename === null) {
            $imageFilename = null;
        }

        createPersonnage($pdo, [

            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':date_naissance' => $_POST['date_naissance'],
            ':id_espece' => $_POST['id_espece'],
            ':id_planete' => $_POST['id_planete'],
            ':image' => $imageFilename
        ]);

        header('Location: index.php?action=personnageListe');
        exit;
    }

    $especes = getAllEspeces($pdo);
    $planetes = getAllPlanetes($pdo);
    require __DIR__ . "/../views/personnages/ajouter.php";
}

function actionPersonnageModifier() {
    $pdo = getConnexion();
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $personnage = getPersonnageById($pdo, $id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = $personnage['image'] ?? null;

        // Upload image (optionnel) - remplace si nouveau fichier
        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/personnages/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('perso_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }
        }

        updatePersonnage($pdo, [
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':date_naissance' => $_POST['date_naissance'],
            ':id_espece' => $_POST['id_espece'],
            ':id_planete' => $_POST['id_planete'],
            ':image' => $imageFilename,
            ':id' => $id
        ]);

        header('Location: index.php?action=personnageListe');
        exit;
    }

    $especes = getAllEspeces($pdo);
    $planetes = getAllPlanetes($pdo);
    require __DIR__ . "/../views/personnages/modifier.php";
}

function actionPersonnageSupprimer() {
    // Pas de champ owner dans le modèle actuel (table: personnage)
    header('Location: index.php?action=personnageListe');
    exit;
}

?>