<?php $pageTitle = 'Ajouter une affiliation'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter une affiliation</h1>
<form method="POST" action="?action=ajouter">
    <label>Nom : <input type="text" name="nom" required></label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="affiliation.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










