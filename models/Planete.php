<?php
function getAllPlanetes2($pdo) {
    return $pdo->query("SELECT * FROM planete")->fetchAll(PDO::FETCH_ASSOC);
}

function getPlaneteById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM planete WHERE id_planete = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createPlanete($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO planete (nom, climat, population, image) VALUES (:nom, :climat, :population, :image)");
    $stmt->execute($data);
}


function updatePlanete($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE planete SET nom=:nom, climat=:climat, population=:population, image=:image WHERE id_planete=:id");
    $stmt->execute($data);
}


function deletePlanete($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM planete WHERE id_planete = :id");
    $stmt->execute([':id' => $id]);
}
?>