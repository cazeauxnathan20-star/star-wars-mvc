<?php
function getAllEspeces2($pdo) {
    return $pdo->query("SELECT * FROM espece")->fetchAll(PDO::FETCH_ASSOC);
}

function getEspeceById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM espece WHERE id_espece = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createEspece($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO espece (nom, description, image) VALUES (:nom, :description, :image)");
    $stmt->execute($data);
}

function updateEspece($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE espece SET nom=:nom, description=:description, image=:image WHERE id_espece=:id");
    $stmt->execute($data);
}

function deleteEspece($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM espece WHERE id_espece = :id");
    $stmt->execute([':id' => $id]);
}
?>