<?php
require_once __DIR__ . '/../core/Repository.php';

class FavoriRepository extends Repository
{
    public function findAll(): array
    {
        $sql = "SELECT f.*, u.pseudo, p.nom, p.prenom 
                FROM favori f
                JOIN utilisateur u ON f.id_user = u.id_user
                JOIN personnage p ON f.id_personnage = p.id_personnage";
        return $this->fetchAll($sql);
    }

    public function create(array $data): void
    {
        $this->execute("INSERT INTO favori (id_user, id_personnage) VALUES (:id_user, :id_personnage)", $data);
    }

    public function delete(int $idUser, int $idPersonnage): void
    {
        $this->execute(
            "DELETE FROM favori WHERE id_user = :id_user AND id_personnage = :id_personnage",
            [':id_user' => $idUser, ':id_personnage' => $idPersonnage]
        );
    }

    public function findAllUtilisateurs(): array
    {
        return $this->fetchAll("SELECT * FROM utilisateur");
    }

    public function findAllPersonnages(): array
    {
        return $this->fetchAll("SELECT * FROM personnage");
    }
}

function getAllFavoris(PDO $pdo): array
{
    return (new FavoriRepository($pdo))->findAll();
}

function createFavori(PDO $pdo, array $data): void
{
    (new FavoriRepository($pdo))->create($data);
}

function deleteFavori(PDO $pdo, int $idUser, int $idPersonnage): void
{
    (new FavoriRepository($pdo))->delete($idUser, $idPersonnage);
}

function getAllUtilisateursPourFavori(PDO $pdo): array
{
    return (new FavoriRepository($pdo))->findAllUtilisateurs();
}

function getAllPersonnagesPourFavori(PDO $pdo): array
{
    return (new FavoriRepository($pdo))->findAllPersonnages();
}
?>