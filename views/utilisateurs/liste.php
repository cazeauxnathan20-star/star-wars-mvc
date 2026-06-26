<?php $pageTitle = 'Utilisateurs Star Wars'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Utilisateurs</h1>
<a href="index.php?action=utilisateurAjouter">Ajouter un utilisateur</a>
<table border="1">
<tr><th>Pseudo</th><th>Email</th><th>Actions</th></tr>
<?php foreach ($utilisateurs as $u): ?>
<tr>
    <td><?= $u['pseudo'] ?></td>
    <td><?= $u['email'] ?></td>
    <td>
        <a href="index.php?action=utilisateurDetail&id=<?= $u['id_user'] ?>">Voir</a>
        <a href="index.php?action=utilisateurModifier&id=<?= $u['id_user'] ?>">Modifier</a>
        <a href="index.php?action=utilisateurSupprimer&id=<?= $u['id_user'] ?>" onclick="return confirm('Sûr ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










