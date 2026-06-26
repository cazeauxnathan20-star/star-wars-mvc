<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Affiliation.php";

function actionAffiliationIndex() {
    $pdo = getConnexion();
    $affiliations = getAllAffiliations($pdo);
    require __DIR__ . "/../views/affiliations/liste.php";
}

function actionAffiliationDetail() {
    $pdo = getConnexion();
    $affiliation = getAffiliationById($pdo, $_GET['id']);
    require __DIR__ . "/../views/affiliations/detail.php";
}

function actionAffiliationAjouter() {
    $pdo = getConnexion();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        createAffiliation($pdo, [':nom' => $_POST['nom']]);
        header('Location: affiliation.php');
        exit;
    }
    require __DIR__ . "/../views/affiliations/ajouter.php";
}

function actionAffiliationModifier() {
    $pdo = getConnexion();
    $affiliation = getAffiliationById($pdo, $_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        updateAffiliation($pdo, [
            ':nom' => $_POST['nom'],
            ':id' => $_GET['id']
        ]);
        header('Location: affiliation.php');
        exit;
    }
    require __DIR__ . "/../views/affiliations/modifier.php";
}

function actionAffiliationSupprimer() {
    $pdo = getConnexion();
    deleteAffiliation($pdo, $_GET['id']);
    header('Location: affiliation.php');
    exit;
}
?>