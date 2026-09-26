<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $file = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($file)) {
            throw new \RuntimeException('Vue introuvable : ' . $file);
        }

        require $file;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
