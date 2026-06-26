<?php
function getAllCommentaires($pdo) {
    $sql = "SELECT c.*, u.pseudo, p.nom, p.prenom
            FROM commentaire c
            LEFT JOIN utilisateur u ON c.id_user = u.id_user
            LEFT JOIN personnage p ON c.id_personnage = p.id_personnage";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function createCommentaire($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO commentaire (contenu, id_user, id_personnage) 
        VALUES (:contenu, :id_user, :id_personnage)");
    $stmt->execute($data);
}

function deleteCommentaire($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM commentaire WHERE id_commentaire = :id");
    $stmt->execute([':id' => $id]);
}

function getAllUtilisateursPourCommentaire($pdo) {
    return $pdo->query("SELECT * FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPersonnagesPourCommentaire($pdo) {
    return $pdo->query("SELECT * FROM personnage")->fetchAll(PDO::FETCH_ASSOC);
}
?>