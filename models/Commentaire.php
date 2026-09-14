<?php
class CommentaireRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT c.*, u.pseudo, p.nom, p.prenom
                FROM commentaire c
                LEFT JOIN utilisateur u ON c.id_user = u.id_user
                LEFT JOIN personnage p ON c.id_personnage = p.id_personnage";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO commentaire (contenu, id_user, id_personnage)
             VALUES (:contenu, :id_user, :id_personnage)"
        );
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE id_commentaire = :id");
        $stmt->execute([':id' => $id]);
    }

    public function findAllUtilisateurs(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM utilisateur");
        return $stmt->fetchAll();
    }

    public function findAllPersonnages(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM personnage");
        return $stmt->fetchAll();
    }

    public function findOwnerById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT id_user FROM commentaire WHERE id_commentaire = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}

function getAllCommentaires(PDO $pdo): array
{
    return (new CommentaireRepository($pdo))->findAll();
}

function createCommentaire(PDO $pdo, array $data): void
{
    (new CommentaireRepository($pdo))->create($data);
}

function deleteCommentaire(PDO $pdo, int $id): void
{
    (new CommentaireRepository($pdo))->delete($id);
}

function getAllUtilisateursPourCommentaire(PDO $pdo): array
{
    return (new CommentaireRepository($pdo))->findAllUtilisateurs();
}

function getAllPersonnagesPourCommentaire(PDO $pdo): array
{
    return (new CommentaireRepository($pdo))->findAllPersonnages();
}
?>