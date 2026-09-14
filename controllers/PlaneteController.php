<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Planete.php";

class PlaneteController
{
    private PDO $pdo;
    private PlaneteRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new PlaneteRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'planeteDetail':
                $this->detail();
                break;
            case 'planeteAjouter':
                $this->ajouter();
                break;
            case 'planeteModifier':
                $this->modifier();
                break;
            case 'planeteSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        $planetes = $this->repository->findAll();
        require __DIR__ . "/../views/planetes/liste.php";
    }

    public function detail(): void
    {
        $planete = $this->repository->findById((int) ($_GET['id'] ?? 0));
        require __DIR__ . "/../views/planetes/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = null;
            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/planetes/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('planete_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->create([
                ':nom' => $_POST['nom'],
                ':climat' => $_POST['climat'],
                ':population' => $_POST['population'],
                ':image' => $imageFilename,
            ]);
            header('Location: index.php?action=planeteListe');
            exit;
        }

        require __DIR__ . "/../views/planetes/ajouter.php";
    }

    public function modifier(): void
    {
        $planete = $this->repository->findById((int) ($_GET['id'] ?? 0));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = $planete['image'] ?? null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/planetes/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('planete_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->update([
                ':nom' => $_POST['nom'],
                ':climat' => $_POST['climat'],
                ':population' => $_POST['population'],
                ':image' => $imageFilename,
                ':id' => (int) $_GET['id'],
            ]);
            header('Location: index.php?action=planeteListe');
            exit;
        }

        require __DIR__ . "/../views/planetes/modifier.php";
    }

    public function supprimer(): void
    {
        header('Location: index.php?action=planeteListe');
        exit;
    }
}
