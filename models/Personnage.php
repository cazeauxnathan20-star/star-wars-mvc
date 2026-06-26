<?php
function getAllPersonnages($pdo) {
    $sql = "SELECT p.*, e.nom AS espece, pl.nom AS planete
            FROM personnage p
            LEFT JOIN espece e ON p.id_espece = e.id_espece
            LEFT JOIN planete pl ON p.id_planete = pl.id_planete";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// 🔎 NOUVELLE FONCTION DE RECHERCHE
function searchPersonnages($pdo, $term) {
    $sql = "SELECT p.*, e.nom AS espece, pl.nom AS planete
            FROM personnage p
            LEFT JOIN espece e ON p.id_espece = e.id_espece
            LEFT JOIN planete pl ON p.id_planete = pl.id_planete
            WHERE p.nom LIKE :term OR p.prenom LIKE :term";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':term' => '%' . $term . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPersonnageById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT p.*, e.nom AS espece, pl.nom AS planete
        FROM personnage p
        LEFT JOIN espece e ON p.id_espece = e.id_espece
        LEFT JOIN planete pl ON p.id_planete = pl.id_planete
        WHERE p.id_personnage = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllEspeces($pdo) {
    return $pdo->query("SELECT * FROM espece")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPlanetes($pdo) {
    return $pdo->query("SELECT * FROM planete")->fetchAll(PDO::FETCH_ASSOC);
}

function createPersonnage($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO personnage (nom, prenom, date_naissance, id_espece, id_planete, image) 
        VALUES (:nom, :prenom, :date_naissance, :id_espece, :id_planete, :image)");
    $stmt->execute($data);
}


function updatePersonnage($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE personnage 
        SET nom=:nom, prenom=:prenom, date_naissance=:date_naissance, id_espece=:id_espece, id_planete=:id_planete, image=:image 
        WHERE id_personnage=:id");
    $stmt->execute($data);
}


function deletePersonnage($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM personnage WHERE id_personnage = :id");
    $stmt->execute([':id' => $id]);
}
?>