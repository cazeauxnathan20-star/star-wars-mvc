<?php $pageTitle = 'Ajouter un vaisseau'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter un vaisseau</h1>
<form method="POST" action="index.php?action=vaisseauAjouter" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" required></label><br>
    <label>Type : <input type="text" name="type"></label><br>
    <label>Capacité : <input type="number" name="capacite"></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <button type="submit">Ajouter</button>
</form>

<a href="index.php?action=vaisseauListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










