<?php $pageTitle = 'Favoris Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Favoris</h1>
<a href="index.php?action=favoriAjouter">Ajouter un favori</a>
<table border="1">
<tr><th>Utilisateur</th><th>Personnage</th><th>Actions</th></tr>
<?php foreach ($favoris as $f): ?>
<tr>
    <td><?= $f['pseudo'] ?></td>
    <td><?= $f['prenom'] ?> <?= $f['nom'] ?></td>
    <td>
        <a href="index.php?action=favoriSupprimer&id_user=<?= $f['id_user'] ?>&id_personnage=<?= $f['id_personnage'] ?>" onclick="return confirm('Sûr ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










