<?php $pageTitle = 'Ajouter un personnage'; require __DIR__ . '/../layout_header.php'; ?>
<h1>Ajouter un personnage</h1>
<form method="POST" action="?action=personnageAjouter" enctype="multipart/form-data">

    <label>Nom : <input type="text" name="nom" required></label><br>
    <label>Prénom : <input type="text" name="prenom"></label><br>
    <label>Date de naissance : <input type="date" name="date_naissance"></label><br>
    <label>Espèce :
        <select name="id_espece">
            <?php foreach ($especes as $e): ?>
                <option value="<?= $e['id_espece'] ?>"><?= $e['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
<label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <label>Planète :


        <select name="id_planete">
            <?php foreach ($planetes as $pl): ?>
                <option value="<?= $pl['id_planete'] ?>"><?= $pl['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Ajouter</button>
</form>
<a href="index.php">← Retour</a>
<?php require __DIR__ . '/../layout_footer.php'; ?>










