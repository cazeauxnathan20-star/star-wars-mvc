<?php $pageTitle = 'Personnages Star Wars'; require __DIR__ . '/../layout_header.php'; ?>


<h1>Personnages Star Wars</h1>

<!-- Barre de recherche -->
<form method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
    <input type="hidden" name="action" value="personnageListe">
    <input type="text" name="search" placeholder="Rechercher..." value="<?= $_GET['search'] ?? '' ?>" style="padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border); background: rgba(255,255,255,0.05); color: var(--text); flex: 1;">
    <button type="submit" class="button button--primary">Rechercher</button>
</form>

<div style="overflow-x: auto;">
<table border="1" style="width: 100%; border-collapse: collapse;">
<tr style="background: rgba(255,255,255,0.05);"><th style="padding: 0.75rem;">Nom</th><th style="padding: 0.75rem;">Prénom</th><th style="padding: 0.75rem;">Espèce</th><th style="padding: 0.75rem;">Planète</th><th style="padding: 0.75rem;">Actions</th></tr>

<?php if (!empty($personnages)): ?>
    <?php foreach ($personnages as $p): ?>
    <tr>
        <td style="padding: 0.75rem;"><?= htmlspecialchars($p['nom']) ?></td>
        <td style="padding: 0.75rem;"><?= htmlspecialchars($p['prenom']) ?></td>
        <td style="padding: 0.75rem;"><?= htmlspecialchars($p['espece']) ?></td>
        <td style="padding: 0.75rem;"><?= htmlspecialchars($p['planete']) ?></td>
        <td style="padding: 0.75rem;">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <?php if (!empty($p['image'])): ?>
                    <img src="public/uploads/personnages/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['nom']) ?>" style="width:50px; height:50px; object-fit:cover; border-radius:8px;" />
                <?php endif; ?>

                <div style="display:flex; flex-direction:column; gap:0.25rem;">
                    <a href="index.php?action=personnageDetail&id=<?= $p['id_personnage'] ?>">Voir</a>
                    <a href="index.php?action=personnageModifier&id=<?= $p['id_personnage'] ?>">Modifier</a>

            <a href="index.php?action=personnageSupprimer&id=<?= $p['id_personnage'] ?>" onclick="return confirm('Tu es sûr ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" style="padding: 0.75rem;">Aucun personnage trouvé</td>
    </tr>
<?php endif; ?>

</table>
</div>

<a href="index.php?action=personnageAjouter" class="button button--primary" style="display: inline-block; margin-top: 1.5rem;">+ Ajouter un personnage</a>

<?php require __DIR__ . '/../layout_footer.php'; ?>










