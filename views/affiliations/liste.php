<?php $pageTitle = 'Affiliations Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Affiliations Star Wars</h1>
<a href="?action=ajouter">Ajouter une affiliation</a>
<table border="1">
<tr><th>Nom</th><th>Actions</th></tr>
<?php foreach ($affiliations as $a): ?>
<tr>
    <td><?= $a['nom'] ?></td>
    <td>
        <a href="?action=detail&id=<?= $a['id_affiliation'] ?>">Voir</a>
        <a href="?action=modifier&id=<?= $a['id_affiliation'] ?>">Modifier</a>
        <a href="?action=supprimer&id=<?= $a['id_affiliation'] ?>" onclick="return confirm('Tu es sûr ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










