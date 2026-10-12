<?php $pageTitle = 'Accueil'; require __DIR__ . '/layout_header.php'; ?>

<section class="home-cards">
    <article class="card">
        <h2>Navigation rapide</h2>
        <ul class="nav-list nav-list--grid">
            <li><a class="button button--ghost" href="index.php?action=filmListe">Films</a></li>
            <li><a class="button button--ghost" href="index.php?action=vaisseauListe">Vaisseaux</a></li>
            <li><a class="button button--ghost" href="index.php?action=personnageListe">Personnages</a></li>
            <li><a class="button button--ghost" href="index.php?action=utilisateurListe">Utilisateurs</a></li>
            <li><a class="button button--ghost" href="index.php?action=favoriListe">Favoris</a></li>
        </ul>
    </article>

    <article class="card card--highlight">
        <h2>Tableau de bord</h2>
        <p>Gérez facilement le catalogue Star Wars et accédez rapidement aux modules disponibles dans l'application.</p>
    </article>
</section>

<section class="film-list">
    <div class="section-head">
        <h2>Films</h2>
        <p class="section-note">Dernières entrées de votre catalogue.</p>
    </div>
    <?php if (!empty($films)): ?>
        <ul class="film-grid">
            <?php foreach ($films as $film): ?>
                <li class="film-item">
                    <a class="film-link" href="index.php?action=filmDetail&id=<?= $film['id_film'] ?>">
                        <strong><?= htmlspecialchars($film['titre']) ?></strong>
                        <span>Épisode <?= htmlspecialchars($film['episode']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun film trouvé pour le moment.</p>
    <?php endif; ?>
</section>

<section class="character-list">
    <div class="section-head">
        <h2>Personnages</h2>
        <p class="section-note">Quelques personnages disponibles dans votre base.</p>
    </div>
    <?php if (!empty($personnages)): ?>
        <ul class="character-grid">
            <?php foreach (array_slice($personnages, 0, 6) as $personnage): ?>
                <li class="character-item">
                    <a class="character-card character-link" href="index.php?action=personnageDetail&id=<?= $personnage['id_personnage'] ?>">
                        <strong><?= htmlspecialchars($personnage['prenom'] . ' ' . $personnage['nom']) ?></strong>
                        <span><?= htmlspecialchars($personnage['espece']) ?> • <?= htmlspecialchars($personnage['planete']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="section-note">Voir tous les personnages sur <a href="index.php?action=personnageListe">la page des personnages</a>.</p>
    <?php else: ?>
        <p>Aucun personnage trouvé pour le moment.</p>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/layout_footer.php'; ?>





