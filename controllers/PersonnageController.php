<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Personnage.php";

class PersonnageController
{
    private PDO $pdo;
    private PersonnageRepository $repository;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnexion();
        $this->repository = new PersonnageRepository($this->pdo);
    }

    public function handle(string $action): void
    {
        switch ($action) {
            case 'personnageDetail':
                $this->detail();
                break;
            case 'personnageAjouter':
                $this->ajouter();
                break;
            case 'personnageModifier':
                $this->modifier();
                break;
            case 'personnageSupprimer':
                $this->supprimer();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(): void
    {
        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $personnages = $this->repository->search($_GET['search']);
        } else {
            $personnages = $this->repository->findAll();
        }

        require __DIR__ . "/../views/personnages/liste.php";
    }

    public function detail(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $personnage = $this->repository->findById($id);
        require __DIR__ . "/../views/personnages/detail.php";
    }

    public function ajouter(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/personnages/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('perso_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->create([
                ':nom' => $_POST['nom'],
                ':prenom' => $_POST['prenom'],
                ':date_naissance' => $_POST['date_naissance'],
                ':id_espece' => $_POST['id_espece'],
                ':id_planete' => $_POST['id_planete'],
                ':image' => $imageFilename,
            ]);

            header('Location: index.php?action=personnageListe');
            exit;
        }

        $especes = $this->repository->findAllEspeces();
        $planetes = $this->repository->findAllPlanetes();
        require __DIR__ . "/../views/personnages/ajouter.php";
    }

    public function modifier(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $personnage = $this->repository->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageFilename = $personnage['image'] ?? null;

            if (isset($_FILES['image']) && is_array($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../public/uploads/personnages/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $originalName = $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($ext, $allowed, true) && is_uploaded_file($tmpName)) {
                    $imageFilename = uniqid('perso_', true) . '.' . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $imageFilename);
                }
            }

            $this->repository->update([
                ':nom' => $_POST['nom'],
                ':prenom' => $_POST['prenom'],
                ':date_naissance' => $_POST['date_naissance'],
                ':id_espece' => $_POST['id_espece'],
                ':id_planete' => $_POST['id_planete'],
                ':image' => $imageFilename,
                ':id' => $id,
            ]);

            header('Location: index.php?action=personnageListe');
            exit;
        }

        $especes = $this->repository->findAllEspeces();
        $planetes = $this->repository->findAllPlanetes();
        require __DIR__ . "/../views/personnages/modifier.php";
    }

    public function supprimer(): void
    {
        header('Location: index.php?action=personnageListe');
        exit;
    }
}
