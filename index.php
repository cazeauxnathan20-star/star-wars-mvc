<?php
require_once __DIR__ . "/controllers/MainController.php";
require_once __DIR__ . "/controllers/RouterControllers.php";

$mainController = new MainController();
$mainController->route($_GET['action'] ?? 'defaut');
?>

