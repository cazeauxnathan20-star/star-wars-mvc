<?php
require_once __DIR__ . '/../core/Repository.php';

class EspeceRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM espece");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM espece WHERE id_espece = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO espece (nom, description, image) VALUES (:nom, :description, :image)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE espece SET nom=:nom, description=:description, image=:image WHERE id_espece=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM espece WHERE id_espece = :id", [':id' => $id]);
    }
}

function getAllEspeces2(PDO $pdo): array
{
    return (new EspeceRepository($pdo))->findAll();
}

function getEspeceById(PDO $pdo, int $id): ?array
{
    return (new EspeceRepository($pdo))->findById($id);
}

function createEspece(PDO $pdo, array $data): void
{
    (new EspeceRepository($pdo))->create($data);
}

function updateEspece(PDO $pdo, array $data): void
{
    (new EspeceRepository($pdo))->update($data);
}

function deleteEspece(PDO $pdo, int $id): void
{
    (new EspeceRepository($pdo))->delete($id);
}
?>