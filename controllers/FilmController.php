<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Film.php';

class FilmController
{
    private Film $filmModel;

    public function __construct()
    {
        $this->filmModel = new Film(Database::getConnexion());
    }

    public function handleAction(string $action): void
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

            case 'filmListe':
            default:
                $this->liste();
                break;
        }
    }

    public function liste(): void
    {
        $films = $this->filmModel->getAll();
        require __DIR__ . '/../views/films/liste.php';
    }

    public function detail(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $film = $this->filmModel->getById($id);

        if ($film === null) {
            header('Location: index.php?action=filmListe');
            exit;
        }

        require __DIR__ . '/../views/films/detail.php';
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donnees = [
                ':titre' => $_POST['titre'] ?? '',
                ':date_sortie' => $_POST['date_sortie'] ?? null,
                ':episode' => (int)($_POST['episode'] ?? 0),
                ':image_url' => $_POST['image_url'] ?? ''
            ];

            $this->filmModel->create($donnees);
            header('Location: index.php?action=filmListe');
            exit;
        }

        require __DIR__ . '/../views/films/ajouter.php';
    }

    public function modifier(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $film = $this->filmModel->getById($id);

        if ($film === null) {
            header('Location: index.php?action=filmListe');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donnees = [
                ':titre' => $_POST['titre'] ?? '',
                ':date_sortie' => $_POST['date_sortie'] ?? null,
                ':episode' => (int)($_POST['episode'] ?? 0),
                ':image_url' => $_POST['image_url'] ?? '',
                ':id' => $id,
            ];

            $this->filmModel->update($donnees);
            header('Location: index.php?action=filmListe');
            exit;
        }

        require __DIR__ . '/../views/films/modifier.php';
    }

    public function supprimer(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            $this->filmModel->delete($id);
        }

        header('Location: index.php?action=filmListe');
        exit;
    }
}
