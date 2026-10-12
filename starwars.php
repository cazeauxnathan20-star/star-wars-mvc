<?php
function getAllFilms($pdo) {
    return $pdo->query("SELECT * FROM film ORDER BY episode")->fetchAll(PDO::FETCH_ASSOC);
}

function getFilmById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createFilm($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO film (titre, date_sortie, episode) VALUES (:titre, :date_sortie, :episode)");
    $stmt->execute($data);
}

function updateFilm($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE film SET titre=:titre, date_sortie=:date_sortie, episode=:episode WHERE id_film=:id");
    $stmt->execute($data);
}

function deleteFilm($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM film WHERE id_film = :id");
    $stmt->execute([':id' => $id]);
}
?>