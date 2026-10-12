<?php
function getAllFavoris($pdo) {
    $sql = "SELECT f.*, u.pseudo, p.nom, p.prenom 
            FROM favori f
            JOIN utilisateur u ON f.id_user = u.id_user
            JOIN personnage p ON f.id_personnage = p.id_personnage";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function createFavori($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO favori (id_user, id_personnage) VALUES (:id_user, :id_personnage)");
    $stmt->execute($data);
}

function deleteFavori($pdo, $id_user, $id_personnage) {
    $stmt = $pdo->prepare("DELETE FROM favori WHERE id_user = :id_user AND id_personnage = :id_personnage");
    $stmt->execute([':id_user' => $id_user, ':id_personnage' => $id_personnage]);
}

function getAllUtilisateursPourFavori($pdo) {
    return $pdo->query("SELECT * FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPersonnagesPourFavori($pdo) {
    return $pdo->query("SELECT * FROM personnage")->fetchAll(PDO::FETCH_ASSOC);
}
?>