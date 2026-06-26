﻿﻿<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Star Wars' ?></title>
<?php
    // Chemin robuste + cache-buster
    // Objectif: garantir que le navigateur recharge le CSS après chaque modification.
    $cssPath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    $cssPath .= '/public/css/style.css';

    $cssFsPath = __DIR__ . '/../public/css/style.css';

    // filemtime peut parfois ne pas changer (ou échouer selon config/permissions).
    // Fallback sur l'heure courante + un petit hash du contenu si possible.
    $v = null;
    if (file_exists($cssFsPath)) {
        $mtime = @filemtime($cssFsPath);
        if ($mtime !== false && $mtime !== null) {
            $v = $mtime;
        }

        if ($v === null) {
            $content = @file_get_contents($cssFsPath);
            if ($content !== false) {
                $v = substr(sha1($content), 0, 12);
            }
        }
    }

    if ($v === null) {
        $v = time();
    }
?>
<link rel="stylesheet" href="<?= $cssPath ?>?v=<?= $v ?>">
<link rel="stylesheet" href="<?= $cssPath ?>?v=<?= $v ?>&extra=card">

</head>
<body>
    <div class="page-shell">
        <header class="site-header">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 class="site-title" style="margin: 0;">
                            <img
                                class="site-title__logo"
                                src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Star_Wars_Logo.svg"
                                alt="Star Wars"
                                loading="eager"
                                style="height: 90px; width: auto;"
                            >
                        </h1>

                        <p style="margin: 0.5rem 0 0; color: var(--muted);">Application de gestion</p>
                    </div>
                    <nav style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="index.php" class="button button--ghost">Accueil</a>
                        <a href="index.php?action=filmListe" class="button button--ghost">Films</a>
                        <a href="index.php?action=personnageListe" class="button button--ghost">Personnages</a>
                        <a href="index.php?action=vaisseauListe" class="button button--ghost">Vaisseaux</a>
                        <a href="index.php?action=utilisateurListe" class="button button--ghost">Utilisateurs</a>
                        <a href="index.php?action=favoriListe" class="button button--ghost">Favoris</a>
                        <a href="index.php?action=planeteListe" class="button button--ghost">Planètes</a>
                        <a href="index.php?action=especeListe" class="button button--ghost">Espèces</a>
                        <a href="index.php?action=commentaireListe" class="button button--ghost">Commentaires</a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="container" style="padding: 2rem 0;">

