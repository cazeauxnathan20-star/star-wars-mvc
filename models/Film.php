<?php
require_once __DIR__ . '/../core/Repository.php';

class FilmRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM film ORDER BY episode");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM film WHERE id_film = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO film (titre, date_sortie, episode, image_url) VALUES (:titre, :date_sortie, :episode, :image_url)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE film SET titre=:titre, date_sortie=:date_sortie, episode=:episode, image_url=:image_url WHERE id_film=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM film WHERE id_film = :id", [':id' => $id]);
    }
}

function getAllFilms(PDO $pdo): array
{
    return (new FilmRepository($pdo))->findAll();
}

function getFilmById(PDO $pdo, int $id): ?array
{
    return (new FilmRepository($pdo))->findById($id);
}

function createFilm(PDO $pdo, array $data): void
{
    (new FilmRepository($pdo))->create($data);
}

function updateFilm(PDO $pdo, array $data): void
{
    (new FilmRepository($pdo))->update($data);
}

function deleteFilm(PDO $pdo, int $id): void
{
    (new FilmRepository($pdo))->delete($id);
}
?>