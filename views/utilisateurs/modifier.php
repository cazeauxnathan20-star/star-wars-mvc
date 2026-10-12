<?php $pageTitle = 'Modifier un utilisateur'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $utilisateur['pseudo'] ?></h1>
<form method="POST" action="index.php?action=utilisateurModifier&id=<?= $utilisateur['id_user'] ?>">
    <label>Pseudo : <input type="text" name="pseudo" value="<?= $utilisateur['pseudo'] ?>" required></label><br>
    <label>Email : <input type="email" name="email" value="<?= $utilisateur['email'] ?>" required></label><br>
    <label>Mot de passe : <input type="password" name="mot_de_passe" required></label><br>
    <button type="submit">Enregistrer</button>
</form>
<a href="index.php?action=utilisateurListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










