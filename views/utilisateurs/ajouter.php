<?php $pageTitle = 'Ajouter un utilisateur'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter un utilisateur</h1>
<form method="POST" action="index.php?action=utilisateurAjouter">
    <label>Pseudo : <input type="text" name="pseudo" required></label><br>
    <label>Email : <input type="email" name="email" required></label><br>
    <label>Mot de passe : <input type="password" name="mot_de_passe" required></label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php?action=utilisateurListe">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










