<?php $pageTitle = 'Ajouter une planète'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter une planète</h1>
<form method="POST" action="?action=planeteAjouter" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" required></label><br>
    <label>Climat : <input type="text" name="climat"></label><br>
    <label>Population : <input type="number" name="population"></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <button type="submit">Ajouter</button>
</form>

<a href="index.php?action=planeteListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










