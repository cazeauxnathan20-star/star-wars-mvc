<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Planete.php";

function actionPlaneteIndex() {
    $pdo = getConnexion();
    $planetes = getAllPlanetes2($pdo);
    require __DIR__ . "/../views/planetes/liste.php";
}

function actionPlaneteDetail() {
    $pdo = getConnexion();
    $planete = getPlaneteById($pdo, $_GET['id']);
    require __DIR__ . "/../views/planetes/detail.php";
}

function actionPlaneteAjouter() {
    $pdo = getConnexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = null;

        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/planetes/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('planete_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }
        }

        createPlanete($pdo, [
            ':nom' => $_POST['nom'],
            ':climat' => $_POST['climat'],
            ':population' => $_POST['population'],
            ':image' => $imageFilename
        ]);
        header('Location: index.php?action=planeteListe');
        exit;
    }

    require __DIR__ . "/../views/planetes/ajouter.php";
}


function actionPlaneteModifier() {
    $pdo = getConnexion();
    $planete = getPlaneteById($pdo, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imageFilename = $planete['image'] ?? null;

        if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../public/uploads/planetes/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $originalName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                $imageFilename = uniqid('planete_', true) . '.' . $ext;
                move_uploaded_file($tmpName, $uploadDir . $imageFilename);
            }
        }

        updatePlanete($pdo, [
            ':nom' => $_POST['nom'],
            ':climat' => $_POST['climat'],
            ':population' => $_POST['population'],
            ':image' => $imageFilename,
            ':id' => $_GET['id']
        ]);
        header('Location: index.php?action=planeteListe');
        exit;
    }

    require __DIR__ . "/../views/planetes/modifier.php";
}


function actionPlaneteSupprimer() {
    header('Location: index.php?action=planeteListe');
    exit;
}

?>