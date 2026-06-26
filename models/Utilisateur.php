<?php
function getAllUtilisateurs($pdo) {
    return $pdo->query("SELECT * FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
}

function getUtilisateurById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createUtilisateur($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe)");
    $stmt->execute($data);
}

function updateUtilisateur($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE utilisateur SET pseudo=:pseudo, email=:email, mot_de_passe=:mot_de_passe WHERE id_user=:id");
    $stmt->execute($data);
}

function deleteUtilisateur($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id_user = :id");
    $stmt->execute([':id' => $id]);
}
?>