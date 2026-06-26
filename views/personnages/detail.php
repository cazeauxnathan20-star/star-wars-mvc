<?php $pageTitle = 'Détails du personnage'; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $personnage['prenom'] ?> <?= $personnage['nom'] ?></h1>

<?php if (!empty($personnage['image'])): ?>
    <img src="public/uploads/personnages/<?= htmlspecialchars($personnage['image']) ?>" alt="<?= htmlspecialchars($personnage['nom']) ?>" style="max-width: 300px; width: 100%; border-radius: 12px; object-fit: cover; display:block; margin-bottom: 1rem;" />
<?php endif; ?>

<p>Espèce : <?= $personnage['espece'] ?></p>
<p>Planète : <?= $personnage['planete'] ?></p>
<p>Date de naissance : <?= $personnage['date_naissance'] ?></p>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










