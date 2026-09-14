<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Vaisseau.php";

class VaisseauController
{
    private PDO $pdo;
    private VaisseauRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new VaisseauRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'vaisseauDetail':
                $this->detail();
                break;
            case 'vaisseauAjouter':
                $this->ajouter();
                break;
            case 'vaisseauModifier':
                $this->modifier();
                break;
            case 'vaisseauSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $vaisseaux = $this->repository->findAll();
        require __DIR__ . "/../views/vaisseaux/liste.php";
    }

    public function detail(): void
    {
        $vaisseau = $this->repository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/vaisseaux/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = null;
            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/vaisseaux/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('vaisseau_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->create([
                ':nom' => $_POST['nom'],
                ':type' => $_POST['type'],
                ':capacite' => $_POST['capacite'],
                ':image' => $imageFilename,
            ]);
            header('Location: index.php?action=vaisseauListe');
            exit;
        }

        require __DIR__ . "/../views/vaisseaux/ajouter.php";
    }

    public function modifier(): void
    {
        $vaisseau = $this->repository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = $vaisseau['image'] ?? null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/vaisseaux/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('vaisseau_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->update([
                ':nom' => $_POST['nom'],
                ':type' => $_POST['type'],
                ':capacite' => $_POST['capacite'],
                ':image' => $imageFilename,
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=vaisseauListe');
            exit;
        }

        require __DIR__ . "/../views/vaisseaux/modifier.php";
    }

    public function supprimer(): void
    {
        header('Location: index.php?action=vaisseauListe');
        exit;
    }
}
