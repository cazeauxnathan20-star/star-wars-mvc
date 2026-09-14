<?php
class Database
{
    private static ?PDO $pdo = null;

    private function __construct()
    {
    }

    public static function getConnexion(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                "mysql:host=127.0.0.1;port=3307;dbname=starwars;charset=utf8",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$pdo;
    }
}

function getConnexion(): PDO
{
    return Database::getConnexion();
}
?>