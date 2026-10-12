<?php $pageTitle = 'Modifier une affiliation'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $affiliation['nom'] ?></h1>
<form method="POST" action="?action=modifier&id=<?= $affiliation['id_affiliation'] ?>">
    <label>Nom : <input type="text" name="nom" value="<?= $affiliation['nom'] ?>" required></label><br>
    <button type="submit">Enregistrer</button>
</form>
<a href="affiliation.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










