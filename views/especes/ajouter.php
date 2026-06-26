<?php $pageTitle = 'Ajouter une espèce'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter une espèce</h1>
<form method="POST" action="?action=especeAjouter" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" required></label><br>
    <label>Description : <textarea name="description"></textarea></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php?action=especeListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










