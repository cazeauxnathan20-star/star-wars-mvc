<?php $pageTitle = 'Détails du vaisseau'; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $vaisseau['nom'] ?></h1>

<?php if (!empty($vaisseau['image'])): ?>
    <img src="public/uploads/vaisseaux/<?= htmlspecialchars($vaisseau['image']) ?>" alt="<?= htmlspecialchars($vaisseau['nom']) ?>" style="max-width: 300px; width: 100%; border-radius: 12px; object-fit: cover; display:block; margin: 1rem 0;" />
<?php endif; ?>

<p>Type : <?= $vaisseau['type'] ?></p>
<p>Capacité : <?= $vaisseau['capacite'] ?></p>
<a href="index.php?action=vaisseauListe">← Retour</a>

<?php require __DIR__ . '/../layout_footer.php'; ?>










