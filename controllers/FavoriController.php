<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Favori.php";

class FavoriController
{
    private PDO $pdo;
    private FavoriRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new FavoriRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'favoriAjouter':
                $this->ajouter();
                break;
            case 'favoriSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $favoris = $this->repository->findAll();
        require __DIR__ . "/../views/favoris/liste.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repository->create([
                ':id_user' => $_POST['id_user'],
                ':id_personnage' => $_POST['id_personnage'],
            ]);
            header('Location: index.php?action=favoriListe');
            exit;
        }

        $utilisateurs = $this->repository->findAllUtilisateurs();
        $personnages = $this->repository->findAllPersonnages();
        require __DIR__ . "/../views/favoris/ajouter.php";
    }

    public function supprimer(): void
    {
        $currentUserId = MainController::getCurrentUserId();
        if ($currentUserId === null) {
            header('Location: index.php?action=favoriListe');
            exit;
        }

        $idPersonnage = isset($_GET['id_personnage']) ? (int) $_GET['id_personnage'] : 0;
        $this->repository->delete($currentUserId, $idPersonnage);
        header('Location: index.php?action=favoriListe');
        exit;
    }
}
