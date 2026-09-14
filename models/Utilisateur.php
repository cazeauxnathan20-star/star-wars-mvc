<?php
require_once __DIR__ . '/../core/Repository.php';

class UtilisateurRepository extends Repository
{
    public function findAll(): array
    {
        return $this->fetchAll("SELECT * FROM utilisateur");
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM utilisateur WHERE id_user = :id", [':id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO utilisateur (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe)",
            $data
        );
    }

    public function update(array $data): void
    {
        $this->execute(
            "UPDATE utilisateur SET pseudo=:pseudo, email=:email, mot_de_passe=:mot_de_passe WHERE id_user=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM utilisateur WHERE id_user = :id", [':id' => $id]);
    }
}

function getAllUtilisateurs(PDO $pdo): array
{
    return (new UtilisateurRepository($pdo))->findAll();
}

function getUtilisateurById(PDO $pdo, int $id): ?array
{
    return (new UtilisateurRepository($pdo))->findById($id);
}

function createUtilisateur(PDO $pdo, array $data): void
{
    (new UtilisateurRepository($pdo))->create($data);
}

function updateUtilisateur(PDO $pdo, array $data): void
{
    (new UtilisateurRepository($pdo))->update($data);
}

function deleteUtilisateur(PDO $pdo, int $id): void
{
    (new UtilisateurRepository($pdo))->delete($id);
}
?>