<?php $pageTitle = 'Modifier une espèce'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $espece['nom'] ?></h1>
<form method="POST" action="?action=especeModifier&id=<?= $espece['id_espece'] ?>" enctype="multipart/form-data">

    <label>Nom : <input type="text" name="nom" value="<?= $espece['nom'] ?>" required></label><br>
    <label>Description : <textarea name="description"><?= $espece['description'] ?></textarea></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>

    <?php if (!empty($espece['image'])): ?>
        <img src="public/uploads/especes/<?= htmlspecialchars($espece['image']) ?>" alt="<?= htmlspecialchars($espece['nom']) ?>" style="width:120px;height:120px;object-fit:cover;border-radius:12px;margin:0.75rem 0;" />
    <?php endif; ?>

    <button type="submit">Enregistrer</button>
</form>
<a href="index.php?action=especeListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










