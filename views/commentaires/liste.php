<?php $pageTitle = 'Commentaires'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Commentaires</h1>

<a href="?action=commentaireAjouter"> Ajouter un commentaire</a>

<table border="1">
<tr>
    <th>Utilisateur</th>
    <th>Personnage</th>
    <th>Contenu</th>
    <th>Action</th>
</tr>

<?php foreach ($commentaires as $c): ?>
<tr>
    <td><?= $c['pseudo'] ?></td>
    <td><?= $c['prenom'] ?> <?= $c['nom'] ?></td>
    <td><?= $c['contenu'] ?></td>
    <td>
        <a href="?action=commentaireSupprimer&id=<?= $c['id_commentaire'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










