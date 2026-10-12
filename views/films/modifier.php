<?php $pageTitle = 'Modifier un film'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $film['titre'] ?></h1>
<form method="POST" action="index.php?action=filmModifier&id=<?= $film['id_film'] ?>">
    <label>Titre : <input type="text" name="titre" value="<?= $film['titre'] ?>" required></label><br>
    <label>Date de sortie : <input type="date" name="date_sortie" value="<?= $film['date_sortie'] ?>"></label><br>
    <label>Épisode : <input type="number" name="episode" value="<?= $film['episode'] ?>"></label><br>
    <label>Lien image : <input type="text" name="image_url" value="<?= htmlspecialchars($film['image_url'] ?? '') ?>"></label><br>
    <button type="submit">Enregistrer</button>
</form>
<a href="index.php?action=filmListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










