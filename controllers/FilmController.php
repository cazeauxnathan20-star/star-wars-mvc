<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Film.php";

class FilmController
{
    private PDO $pdo;
    private FilmRepository $filmRepository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->filmRepository = new FilmRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'filmDetail':
                $this->detail();
                break;

            case 'filmAjouter':
                $this->ajouter();
                break;

            case 'filmModifier':
                $this->modifier();
                break;

            case 'filmSupprimer':
                $this->supprimer();
                break;

            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $films = $this->filmRepository->findAll();
        require __DIR__ . "/../views/films/liste.php";
    }

    public function detail(): void
    {
        $film = $this->filmRepository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/films/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->filmRepository->create([
                ':titre' => $_POST['titre'],
                ':date_sortie' => $_POST['date_sortie'],
                ':episode' => $_POST['episode'],
                ':image_url' => $_POST['image_url'],
            ]);
            header('Location: index.php?action=filmListe');
            exit;
        }

        require __DIR__ . "/../views/films/ajouter.php";
    }

    public function modifier(): void
    {
        $film = $this->filmRepository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->filmRepository->update([
                ':titre' => $_POST['titre'],
                ':date_sortie' => $_POST['date_sortie'],
                ':episode' => $_POST['episode'],
                ':image_url' => $_POST['image_url'],
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=filmListe');
            exit;
        }

        require __DIR__ . "/../views/films/modifier.php";
    }

    public function supprimer(): void
    {
        header('Location: index.php?action=filmListe');
        exit;
    }
}
