<?php
function getConnexion() {
    $pdo = new PDO("mysql:host=sql305.infinityfree.com;port=3306;dbname=if0_42185867_starwars;charset=utf8", "if0_42185867", "Nathan0074000");
    return $pdo;
}
?>