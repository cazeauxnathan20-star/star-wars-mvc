<?php $pageTitle = 'Ajouter un film'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter un film</h1>
<form method="POST" action="index.php?action=filmAjouter">
    <label>Titre : <input type="text" name="titre" required></label><br>
    <label>Date de sortie : <input type="date" name="date_sortie"></label><br>
    <label>Épisode : <input type="number" name="episode"></label><br>
    <label>Lien image : <input type="text" name="image_url"></label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php?action=filmListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>












