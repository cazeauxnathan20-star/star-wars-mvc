<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Utilisateur.php";

class UtilisateurController
{
    private PDO $pdo;
    private UtilisateurRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new UtilisateurRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'utilisateurDetail':
                $this->detail();
                break;
            case 'utilisateurAjouter':
                $this->ajouter();
                break;
            case 'utilisateurModifier':
                $this->modifier();
                break;
            case 'utilisateurSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $utilisateurs = $this->repository->findAll();
        require __DIR__ . "/../views/utilisateurs/liste.php";
    }

    public function detail(): void
    {
        $utilisateur = $this->repository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/utilisateurs/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->create([
                ':pseudo' => $_POST['pseudo'],
                ':email' => $_POST['email'],
                ':mot_de_passe' => $_POST['mot_de_passe'],
            ]);
            header('Location: index.php?action=utilisateurListe');
            exit;
        }

        require __DIR__ . "/../views/utilisateurs/ajouter.php";
    }

    public function modifier(): void
    {
        $utilisateur = $this->repository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->update([
                ':pseudo' => $_POST['pseudo'],
                ':email' => $_POST['email'],
                ':mot_de_passe' => $_POST['mot_de_passe'],
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=utilisateurListe');
            exit;
        }

        require __DIR__ . "/../views/utilisateurs/modifier.php";
    }

    public function supprimer(): void
    {
        $currentUserId = MainController::getCurrentUserId();
        if ($currentUserId === null) {
            header('Location: index.php?action=utilisateurListe');
            exit;
        }

        MainController::requireOwnershipOrDeny((string) ($_GET['id'] ?? 0), 'index.php?action=utilisateurListe');
        $this->repository->delete((int) $_GET['id']);
        header('Location: index.php?action=utilisateurListe');
        exit;
    }
}
