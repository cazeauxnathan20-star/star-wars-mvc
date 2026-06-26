<?php $pageTitle = 'Films Star Wars'; require __DIR__ . '/../layout_header.php'; ?>


<h1>Films Star Wars</h1>
<a href="index.php?action=filmAjouter" class="button button--primary" style="display: inline-block; margin-bottom: 1.5rem;">Ajouter un film</a>

<div class="home-cards" style="margin-top:1.25rem">
<?php foreach ($films as $f): ?>
  <div class="sw-entity-card">
    <div class="sw-entity-media">
      <img alt="Film <?= htmlspecialchars($f['titre'] ?? '') ?>" src="<?= htmlspecialchars($f['image_url'] ?? '') ?>" loading="lazy">
    </div>
    <div class="sw-entity-body">
      <h3 class="sw-entity-title">Episode <?= $f['episode'] ?></h3>
      <p class="sw-entity-subtitle" style="margin:0 0 .5rem;"><?= htmlspecialchars($f['titre']) ?></p>
      <p style="margin:0;color:var(--muted);">Sortie : <?= $f['date_sortie'] ?></p>
      <div style="margin-top:0.9rem; display:flex; gap:0.6rem; flex-wrap:wrap;">
        <a href="index.php?action=filmDetail&id=<?= $f['id_film'] ?>" class="button button--secondary">Voir</a>
        <a href="index.php?action=filmModifier&id=<?= $f['id_film'] ?>" class="button button--secondary">Modifier</a>
        <a href="index.php?action=filmSupprimer&id=<?= $f['id_film'] ?>" class="button button--secondary" onclick="return confirm('Sûr ?')">Supprimer</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>


<?php require __DIR__ . '/../layout_footer.php'; ?>











