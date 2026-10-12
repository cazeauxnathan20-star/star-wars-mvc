<?php
function getAllAffiliations($pdo) {
    return $pdo->query("SELECT * FROM affiliation")->fetchAll(PDO::FETCH_ASSOC);
}

function getAffiliationById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM affiliation WHERE id_affiliation = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createAffiliation($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO affiliation (nom) VALUES (:nom)");
    $stmt->execute($data);
}

function updateAffiliation($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE affiliation SET nom=:nom WHERE id_affiliation=:id");
    $stmt->execute($data);
}

function deleteAffiliation($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM affiliation WHERE id_affiliation = :id");
    $stmt->execute([':id' => $id]);
}
?>