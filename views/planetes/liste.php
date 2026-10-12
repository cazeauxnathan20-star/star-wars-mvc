<?php $pageTitle = 'Planètes Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Planètes Star Wars</h1>
<a href="?action=planeteAjouter"> Ajouter une planète</a>
<table border="1">
<tr><th>Nom</th><th>Climat</th><th>Population</th><th>Actions</th></tr>
<?php foreach ($planetes as $pl): ?>
<tr>
    <td><?= $pl['nom'] ?></td>
    <td><?= $pl['climat'] ?></td>
    <td><?= $pl['population'] ?></td>
    <td>
        <?php if (!empty($pl['image'])): ?>
            <img src="public/uploads/planetes/<?= htmlspecialchars($pl['image']) ?>" alt="<?= htmlspecialchars($pl['nom']) ?>" style="width:50px; height:50px; object-fit:cover; border-radius:8px; margin-right:0.5rem; vertical-align:middle;" />
        <?php endif; ?>
        <a href="?action=planeteDetail&id=<?= $pl['id_planete'] ?>">Voir</a>
        <a href="?action=planeteModifier&id=<?= $pl['id_planete'] ?>">Modifier</a>
<a href="?action=planeteSupprimer&id=<?= $pl['id_planete'] ?>" onclick="return confirm('Tu es sûr ?')">Supprimer</a>
    </td>
</tr>

<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










