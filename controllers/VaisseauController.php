<?php
require_once __DIR__ . "/../models/Vaisseau.php";

function handleVaisseau($action) {
    $pdo = getConnexion();
    switch ($action) {
        case 'vaisseauDetail':
            $vaisseau = getVaisseauById($pdo, $_GET['id']);
            require __DIR__ . "/../views/vaisseaux/detail.php";
            break;

        case 'vaisseauAjouter':
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

                createVaisseau($pdo, [
                    ':nom'      => $_POST['nom'],
                    ':type'     => $_POST['type'],
                    ':capacite' => $_POST['capacite'],
                    ':image'    => $imageFilename
                ]);
                header('Location: index.php?action=vaisseauListe');
                exit;
            }
            require __DIR__ . "/../views/vaisseaux/ajouter.php";
            break;


        case 'vaisseauModifier':
            $vaisseau = getVaisseauById($pdo, $_GET['id']);
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

                updateVaisseau($pdo, [
                    ':nom'      => $_POST['nom'],
                    ':type'     => $_POST['type'],
                    ':capacite' => $_POST['capacite'],
                    ':image'    => $imageFilename,
                    ':id'       => $_GET['id']
                ]);
                header('Location: index.php?action=vaisseauListe');
                exit;
            }
            require __DIR__ . "/../views/vaisseaux/modifier.php";
            break;


        case 'vaisseauSupprimer':
            header('Location: index.php?action=vaisseauListe');
            exit;


        default:
            $vaisseaux = getAllVaisseaux($pdo);
            require __DIR__ . "/../views/vaisseaux/liste.php";
            break;
    }
}
?>