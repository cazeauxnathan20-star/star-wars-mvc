<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Espece.php";

function actionEspeceIndex() {
    $pdo = getConnexion();
    $especes = getAllEspeces2($pdo);
    require __DIR__ . "/../views/especes/liste.php";
}

function actionEspeceDetail() {
    $pdo = getConnexion();
    $espece = getEspeceById($pdo, $_GET['id']);
    require __DIR__ . "/../views/especes/detail.php";
}

function actionEspeceAjouter() {
    $pdo = getConnexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = null;

        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/especes/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('espece_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }
        }

        createEspece($pdo, [
            ':nom' => $_POST['nom'],
            ':description' => $_POST['description'],
            ':image' => $imageFilename
        ]);

        header('Location: index.php?action=especeListe');
        exit;
    }

    require __DIR__ . "/../views/especes/ajouter.php";
}

function actionEspeceModifier() {
    $pdo = getConnexion();
    $espece = getEspeceById($pdo, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = $espece['image'] ?? null;

        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/especes/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('espece_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }
        }

        updateEspece($pdo, [
            ':nom' => $_POST['nom'],
            ':description' => $_POST['description'],
            ':image' => $imageFilename,
            ':id' => $_GET['id']
        ]);

        header('Location: index.php?action=especeListe');
        exit;
    }

    require __DIR__ . "/../views/especes/modifier.php";
}

function actionEspeceSupprimer() {
    header('Location: index.php?action=especeListe');
    exit;
}

?>