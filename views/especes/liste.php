<?php $pageTitle = 'Espèces Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Espèces Star Wars</h1>
<a href="index.php?action=especeAjouter"> Ajouter une espèce</a>
<table border="1">
<tr><th>Nom</th><th>Description</th><th>Actions</th></tr>
<?php foreach ($especes as $e): ?>
<tr>
    <td><?= $e['nom'] ?></td>
    <td><?= $e['description'] ?></td>
    <td>
        <a href="index.php?action=especeDetail&id=<?= $e['id_espece'] ?>">Voir</a>
        <a href="index.php?action=especeModifier&id=<?= $e['id_espece'] ?>">Modifier</a>
        <a href="index.php?action=especeSupprimer&id=<?= $e['id_espece'] ?>" onclick="return confirm('Tu es sûr ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>











