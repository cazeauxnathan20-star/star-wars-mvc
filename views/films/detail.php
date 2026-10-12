<?php $pageTitle = 'Détails du film'; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $film['titre'] ?></h1>
<p>Épisode : <?= $film['episode'] ?></p>
<p>Date de sortie : <?= $film['date_sortie'] ?></p>
<a href="index.php?action=filmListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










