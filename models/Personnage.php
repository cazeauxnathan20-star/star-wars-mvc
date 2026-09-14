<?php
require_once __DIR__ . '/../core/Repository.php';

class PersonnageRepository extends Repository
{
    public function findAll(): array
    {
        $sql = "SELECT p.*, e.nom AS espece, pl.nom AS planete
                FROM personnage p
                LEFT JOIN espece e ON p.id_espece = e.id_espece
                LEFT JOIN planete pl ON p.id_planete = pl.id_planete";
        return $this->fetchAll($sql);
    }

    public function search(string $term): array
    {
        $sql = "SELECT p.*, e.nom AS espece, pl.nom AS planete
                FROM personnage p
                LEFT JOIN espece e ON p.id_espece = e.id_espece
                LEFT JOIN planete pl ON p.id_planete = pl.id_planete
                WHERE p.nom LIKE :term OR p.prenom LIKE :term";
        return $this->fetchAll($sql, [':term' => '%' . $term . '%']);
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT p.*, e.nom AS espece, pl.nom AS planete
                FROM personnage p
                LEFT JOIN espece e ON p.id_espece = e.id_espece
                LEFT JOIN planete pl ON p.id_planete = pl.id_planete
                WHERE p.id_personnage = :id";
        return $this->fetchOne($sql, [':id' => $id]);
    }

    public function findAllEspeces(): array
    {
        return $this->fetchAll("SELECT * FROM espece");
    }

    public function findAllPlanetes(): array
    {
        return $this->fetchAll("SELECT * FROM planete");
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO personnage (nom, prenom, date_naissance, id_espece, id_planete, image) 
             VALUES (:nom, :prenom, :date_naissance, :id_espece, :id_planete, :image)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE personnage 
             SET nom=:nom, prenom=:prenom, date_naissance=:date_naissance, id_espece=:id_espece, id_planete=:id_planete, image=:image 
             WHERE id_personnage=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM personnage WHERE id_personnage = :id", [':id' => $id]);
    }
}

function getAllPersonnages(PDO $pdo): array
{
    return (new PersonnageRepository($pdo))->findAll();
}

function searchPersonnages(PDO $pdo, string $term): array
{
    return (new PersonnageRepository($pdo))->search($term);
}

function getPersonnageById(PDO $pdo, int $id): ?array
{
    return (new PersonnageRepository($pdo))->findById($id);
}

function getAllEspeces(PDO $pdo): array
{
    return (new PersonnageRepository($pdo))->findAllEspeces();
}

function getAllPlanetes(PDO $pdo): array
{
    return (new PersonnageRepository($pdo))->findAllPlanetes();
}

function createPersonnage(PDO $pdo, array $data): void
{
    (new PersonnageRepository($pdo))->create($data);
}

function updatePersonnage(PDO $pdo, array $data): void
{
    (new PersonnageRepository($pdo))->update($data);
}

function deletePersonnage(PDO $pdo, int $id): void
{
    (new PersonnageRepository($pdo))->delete($id);
}
?>