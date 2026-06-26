<?php
function getAllVaisseaux($pdo) {
    return $pdo->query("SELECT * FROM vaisseau")->fetchAll(PDO::FETCH_ASSOC);
}

function getVaisseauById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM vaisseau WHERE id_vaisseau = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createVaisseau($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO vaisseau (nom, type, capacite, image) VALUES (:nom, :type, :capacite, :image)");
    $stmt->execute($data);
}


function updateVaisseau($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE vaisseau SET nom=:nom, type=:type, capacite=:capacite, image=:image WHERE id_vaisseau=:id");
    $stmt->execute($data);
}


function deleteVaisseau($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM vaisseau WHERE id_vaisseau = :id");
    $stmt->execute([':id' => $id]);
}
?>