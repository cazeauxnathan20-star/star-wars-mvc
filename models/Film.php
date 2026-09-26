<?php
class Film
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $query = $this->pdo->query('SELECT * FROM film ORDER BY episode');
        return $query->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM film WHERE id_film = :id');
        $stmt->execute([':id' => $id]);
        $film = $stmt->fetch();

        return $film ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO film (titre, date_sortie, episode, image_url)
             VALUES (:titre, :date_sortie, :episode, :image_url)'
        );

        return $stmt->execute($data);
    }

    public function update(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE film
             SET titre = :titre,
                 date_sortie = :date_sortie,
                 episode = :episode,
                 image_url = :image_url
             WHERE id_film = :id'
        );

        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM film WHERE id_film = :id');
        return $stmt->execute([':id' => $id]);
    }
}
