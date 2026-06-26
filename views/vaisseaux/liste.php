<?php $pageTitle = 'Vaisseaux Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Vaisseaux Star Wars</h1>
<a href="index.php?action=vaisseauAjouter">Ajouter un vaisseau</a>
<table border="1">
<tr><th>Nom</th><th>Type</th><th>Capacité</th><th>Actions</th></tr>
<?php foreach ($vaisseaux as $v): ?>
<tr>
    <td><?= $v['nom'] ?></td>
    <td><?= $v['type'] ?></td>
    <td><?= $v['capacite'] ?></td>
    <td>
        <?php if (!empty($v['image'])): ?>
            <img src="public/uploads/vaisseaux/<?= htmlspecialchars($v['image']) ?>" alt="<?= htmlspecialchars($v['nom']) ?>" style="width:50px; height:50px; object-fit:cover; border-radius:8px; margin-right:0.5rem; vertical-align:middle;" />
        <?php endif; ?>
        <a href="index.php?action=vaisseauDetail&id=<?= $v['id_vaisseau'] ?>">Voir</a>
        <a href="index.php?action=vaisseauModifier&id=<?= $v['id_vaisseau'] ?>">Modifier</a>
        <a href="index.php?action=vaisseauSupprimer&id=<?= $v['id_vaisseau'] ?>" onclick="return confirm('Sûr ?')">Supprimer</a>
    </td>
</tr>

<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










