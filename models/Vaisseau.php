<?php
require_once __DIR__ . '/../core/Repository.php';

class VaisseauRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM vaisseau");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM vaisseau WHERE id_vaisseau = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO vaisseau (nom, type, capacite, image) VALUES (:nom, :type, :capacite, :image)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE vaisseau SET nom=:nom, type=:type, capacite=:capacite, image=:image WHERE id_vaisseau=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM vaisseau WHERE id_vaisseau = :id", [':id' => $id]);
    }
}

function getAllVaisseaux(PDO $pdo): array
{
    return (new VaisseauRepository($pdo))->findAll();
}

function getVaisseauById(PDO $pdo, int $id): ?array
{
    return (new VaisseauRepository($pdo))->findById($id);
}

function createVaisseau(PDO $pdo, array $data): void
{
    (new VaisseauRepository($pdo))->create($data);
}

function updateVaisseau(PDO $pdo, array $data): void
{
    (new VaisseauRepository($pdo))->update($data);
}

function deleteVaisseau(PDO $pdo, int $id): void
{
    (new VaisseauRepository($pdo))->delete($id);
}
?>