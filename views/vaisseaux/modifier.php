<?php $pageTitle = 'Modifier un vaisseau'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $vaisseau['nom'] ?></h1>
<form method="POST" action="index.php?action=vaisseauModifier&id=<?= $vaisseau['id_vaisseau'] ?>" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" value="<?= $vaisseau['nom'] ?>" required></label><br>
    <label>Type : <input type="text" name="type" value="<?= $vaisseau['type'] ?>"></label><br>
    <label>Capacité : <input type="number" name="capacite" value="<?= $vaisseau['capacite'] ?>"></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <?php if (!empty($vaisseau['image'])): ?>
        <img src="public/uploads/vaisseaux/<?= htmlspecialchars($vaisseau['image']) ?>" alt="<?= htmlspecialchars($vaisseau['nom']) ?>" style="width:120px;height:120px;object-fit:cover;border-radius:12px;margin:0.75rem 0;" />
    <?php endif; ?>
    <button type="submit">Enregistrer</button>
</form>

<a href="index.php?action=vaisseauListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










