<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Espece.php";

class EspeceController
{
    private PDO $pdo;
    private EspeceRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new EspeceRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'especeDetail':
                $this->detail();
                break;
            case 'especeAjouter':
                $this->ajouter();
                break;
            case 'especeModifier':
                $this->modifier();
                break;
            case 'especeSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $especes = $this->repository->findAll();
        require __DIR__ . "/../views/especes/liste.php";
    }

    public function detail(): void
    {
        $espece = $this->repository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/especes/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/especes/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('espece_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->create([
                ':nom' => $_POST['nom'],
                ':description' => $_POST['description'],
                ':image' => $imageFilename,
            ]);
            header('Location: index.php?action=especeListe');
            exit;
        }

        require __DIR__ . "/../views/especes/ajouter.php";
    }

    public function modifier(): void
    {
        $espece = $this->repository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = $espece['image'] ?? null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/especes/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('espece_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->update([
                ':nom' => $_POST['nom'],
                ':description' => $_POST['description'],
                ':image' => $imageFilename,
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=especeListe');
            exit;
        }

        require __DIR__ . "/../views/especes/modifier.php";
    }

    public function supprimer(): void
    {
        header('Location: index.php?action=especeListe');
        exit;
    }
}
