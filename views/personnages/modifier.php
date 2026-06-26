<?php $pageTitle = 'Modifier un personnage'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Modifier <?= $personnage['prenom'] ?> <?= $personnage['nom'] ?></h1>
<form method="POST" action="?action=personnageModifier&id=<?= $personnage['id_personnage'] ?>" enctype="multipart/form-data">

    <label>Nom : <input type="text" name="nom" value="<?= $personnage['nom'] ?>" required></label><br>
    <label>Prénom : <input type="text" name="prenom" value="<?= $personnage['prenom'] ?>"></label><br>
    <label>Date de naissance : <input type="date" name="date_naissance" value="<?= $personnage['date_naissance'] ?>"></label><br>

    <label>Image : <input type="file" name="image" accept="image/*"></label><br>

    <label>Espèce :
        <select name="id_espece">
            <?php foreach ($especes as $e): ?>
                <option value="<?= $e['id_espece'] ?>" <?= $e['id_espece'] == $personnage['id_espece'] ? 'selected' : '' ?>><?= $e['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Planète :
        <select name="id_planete">
            <?php foreach ($planetes as $pl): ?>
                <option value="<?= $pl['id_planete'] ?>" <?= $pl['id_planete'] == $personnage['id_planete'] ? 'selected' : '' ?>><?= $pl['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Enregistrer</button>
</form>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










