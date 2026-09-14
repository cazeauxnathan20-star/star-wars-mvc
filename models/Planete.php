<?php
require_once __DIR__ . '/../core/Repository.php';

class PlaneteRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM planete");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM planete WHERE id_planete = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO planete (nom, climat, population, image) VALUES (:nom, :climat, :population, :image)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE planete SET nom=:nom, climat=:climat, population=:population, image=:image WHERE id_planete=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM planete WHERE id_planete = :id", [':id' => $id]);
    }
}

function getAllPlanetes2(PDO $pdo): array
{
    return (new PlaneteRepository($pdo))->findAll();
}

function getPlaneteById(PDO $pdo, int $id): ?array
{
    return (new PlaneteRepository($pdo))->findById($id);
}

function createPlanete(PDO $pdo, array $data): void
{
    (new PlaneteRepository($pdo))->create($data);
}

function updatePlanete(PDO $pdo, array $data): void
{
    (new PlaneteRepository($pdo))->update($data);
}

function deletePlanete(PDO $pdo, int $id): void
{
    (new PlaneteRepository($pdo))->delete($id);
}
?>