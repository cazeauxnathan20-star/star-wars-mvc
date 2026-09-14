<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Affiliation.php";

class AffiliationController
{
    private PDO $pdo;
    private AffiliationRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new AffiliationRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'affiliationDetail':
                $this->detail();
                break;
            case 'affiliationAjouter':
                $this->ajouter();
                break;
            case 'affiliationModifier':
                $this->modifier();
                break;
            case 'affiliationSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $affiliations = $this->repository->findAll();
        require __DIR__ . "/../views/affiliations/liste.php";
    }

    public function detail(): void
    {
        $affiliation = $this->repository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/affiliations/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->create([':nom' => $_POST['nom']]);
            header('Location: index.php?action=affiliationListe');
            exit;
        }

        require __DIR__ . "/../views/affiliations/ajouter.php";
    }

    public function modifier(): void
    {
        $affiliation = $this->repository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->update([
                ':nom' => $_POST['nom'],
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=affiliationListe');
            exit;
        }

        require __DIR__ . "/../views/affiliations/modifier.php";
    }

    public function supprimer(): void
    {
        $this->repository->delete((int) ($_GET['id'] ?? 0));
        header('Location: index.php?action=affiliationListe');
        exit;
    }
}
