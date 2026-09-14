<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Commentaire.php";

class CommentaireController
{
    private PDO $pdo;
    private CommentaireRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new CommentaireRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'commentaireAjouter':
                $this->ajouter();
                break;
            case 'commentaireSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $commentaires = $this->repository->findAll();
        require __DIR__ . "/../views/commentaires/liste.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->create([
                ':contenu' => $_POST['contenu'],
                ':id_user' => $_POST['id_user'],
                ':id_personnage' => $_POST['id_personnage'],
            ]);

            header('Location: index.php?action=commentaireListe');
            exit;
        }

        $utilisateurs = $this->repository->findAllUtilisateurs();
        $personnages = $this->repository->findAllPersonnages();

        require __DIR__ . "/../views/commentaires/ajouter.php";
    }

    public function supprimer(): void
    {
        $currentUserId = MainController::getCurrentUserId();
        if ($currentUserId === null) {
            header('Location: index.php?action=commentaireListe');
            exit;
        }

        $row = $this->repository->findOwnerById((int) ($_GET['id'] ?? 0));
        if ($row === null) {
            header('Location: index.php?action=commentaireListe');
            exit;
        }

        MainController::requireOwnershipOrDeny((string) $row['id_user'], 'index.php?action=commentaireListe');
        $this->repository->delete((int) $_GET['id']);

        header('Location: index.php?action=commentaireListe');
        exit;
    }
}


