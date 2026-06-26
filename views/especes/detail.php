<?php $pageTitle = "Détails de l'espèce"; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $espece['nom'] ?></h1>

<?php if (!empty($espece['image'])): ?>
    <img src="public/uploads/especes/<?= htmlspecialchars($espece['image']) ?>" alt="<?= htmlspecialchars($espece['nom']) ?>" style="max-width: 300px; width: 100%; border-radius: 12px; object-fit: cover; display:block; margin: 1rem 0;" />
<?php endif; ?>

<p>Description : <?= $espece['description'] ?></p>
<a href="index.php?action=especeListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>











