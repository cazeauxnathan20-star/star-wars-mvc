<?php $pageTitle = 'Modifier une planète'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $planete['nom'] ?></h1>
<form method="POST" action="?action=planeteModifier&id=<?= $planete['id_planete'] ?>" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" value="<?= $planete['nom'] ?>" required></label><br>
    <label>Climat : <input type="text" name="climat" value="<?= $planete['climat'] ?>"></label><br>
    <label>Population : <input type="number" name="population" value="<?= $planete['population'] ?>"></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <?php if (!empty($planete['image'])): ?>
        <img src="public/uploads/planetes/<?= htmlspecialchars($planete['image']) ?>" alt="<?= htmlspecialchars($planete['nom']) ?>" style="width:120px;height:120px;object-fit:cover;border-radius:12px;margin:0.75rem 0;" />
    <?php endif; ?>
    <button type="submit">Enregistrer</button>
</form>

<a href="index.php?action=planeteListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










