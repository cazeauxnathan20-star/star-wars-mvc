<?php $pageTitle = "Détails de l'utilisateur"; require __DIR__ . '/../layout_header.php'; ?>
<h1><?= $utilisateur['pseudo'] ?></h1>
<p>Email : <?= $utilisateur['email'] ?></p>
<a href="index.php?action=utilisateurListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










