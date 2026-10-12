<?php $pageTitle = 'Détails de la planète'; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $planete['nom'] ?></h1>

<?php if (!empty($planete['image'])): ?>
    <img src="public/uploads/planetes/<?= htmlspecialchars($planete['image']) ?>" alt="<?= htmlspecialchars($planete['nom']) ?>" style="max-width: 300px; width: 100%; border-radius: 12px; object-fit: cover; display:block; margin: 1rem 0;" />
<?php endif; ?>

<p>Climat : <?= $planete['climat'] ?></p>
<p>Population : <?= $planete['population'] ?></p>
<a href="index.php?action=planeteListe">← Retour</a>

<?php require __DIR__ . '/../layout_footer.php'; ?>










