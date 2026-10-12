<?php $pageTitle = 'Ajouter un favori'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter un favori</h1>
<form method="POST" action="index.php?action=favoriAjouter">
    <label>Utilisateur :
        <select name="id_user">
            <?php foreach ($utilisateurs as $u): ?>
                <option value="<?= $u['id_user'] ?>"><?= $u['pseudo'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Personnage :
        <select name="id_personnage">
            <?php foreach ($personnages as $p): ?>
                <option value="<?= $p['id_personnage'] ?>"><?= $p['prenom'] ?> <?= $p['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php?action=favoriListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










