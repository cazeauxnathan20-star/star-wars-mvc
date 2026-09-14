<?php
require_once __DIR__ . '/../core/Repository.php';

class AffiliationRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM affiliation");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM affiliation WHERE id_affiliation = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute("INSERT INTO affiliation (nom) VALUES (:nom)", $data);
    }

    public function update(array $data): void
    {
        $this->execute("UPDATE affiliation SET nom=:nom WHERE id_affiliation=:id", $data);
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM affiliation WHERE id_affiliation = :id", [':id' => $id]);
    }
}

function getAllAffiliations(PDO $pdo): array
{
    return (new AffiliationRepository($pdo))->findAll();
}

function getAffiliationById(PDO $pdo, int $id): ?array
{
    return (new AffiliationRepository($pdo))->findById($id);
}

function createAffiliation(PDO $pdo, array $data): void
{
    (new AffiliationRepository($pdo))->create($data);
}

function updateAffiliation(PDO $pdo, array $data): void
{
    (new AffiliationRepository($pdo))->update($data);
}

function deleteAffiliation(PDO $pdo, int $id): void
{
    (new AffiliationRepository($pdo))->delete($id);
}
?>